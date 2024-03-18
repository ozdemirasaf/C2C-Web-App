<?php
require_once 'header.php';

islemkontrol();
?>

<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">

    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">



                <div class="settings-details tab-content">

                    <div class="tab-pane fade active in" id="Personal">

                        <h2 class="title-section">Tamamlanan Siparişler</h2>

                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tarihi</th>
                                        <th scope="col">Sipariş No</th>
                                        <th scope="col">Ürün Ad</th>
                                        <th scope="col">Ürün Fiyat</th>
                                        <th scope="col">Durum</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $siparissor = $db->prepare("SELECT siparis.*,siparis_detay.*,kullanici.*, urun.* FROM siparis INNER JOIN siparis_detay ON 
                                    siparis.siparis_id=siparis_detay.siparis_id INNER JOIN kullanici ON siparis_detay.kullanici_idsatici=kullanici.kullanici_id INNER JOIN urun 
                                    ON urun.urun_id=siparis_detay.urun_id
                                    WHERE siparis.kullanici_idsatici=:kullanici_idsatici AND siparis_detay.siparisdetay_siparisdetay_onay=:onay order by siparis_zaman DESC");
                                    $siparissor->execute(array(
                                        'kullanici_idsatici' => $_SESSION['kullaniciID'],
                                        'onay' => 2
                                    ));
                                    $say = 1;
                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {

                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $say++ ?></th>
                                            <td><?php echo $sipariscek['siparis_zaman'] ?></td>
                                            <td><?php echo $sipariscek['siparis_id'] ?></td>
                                            <td><?php echo $sipariscek['urun_ad'] ?></td>
                                            <td><?php echo $sipariscek['urun_fiyat'] ?></td>
                                            <td>
                                                <?php
                                                if ($sipariscek['siparisdetay_siparisdetay_onay'] == 0) {
                                                ?>
                                                    <a onclick="return confrim('Ürüne Onay Veriyorsunuz Bu işlem Geri Alınamaz!!')" href="nedmin/netting/kullaniciislemleri.php?urunTeslim=ok&urundetayId=<?php echo $sipariscek['siparisdetay_id'] ?>&urunId=<?php echo $sipariscek['siparis_id'] ?>"><button class="btn btn-warning btn-xs">Teslim Et</button></a>
                                                <?php
                                                } else if ($sipariscek['siparisdetay_siparisdetay_onay'] == 1) {
                                                ?>
                                                    <button class="btn btn-success btn-xs">Alıcıdan Onay Bekliyor</button>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>




                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php' ?>


<script>
    $(document).ready(function() {

        $("#kullanici_tip").change(function() {

            var tip = $("#kullanici_tip").val();

            if (tip == "PERSONAL") {

                $("#kurumsal").hide();
                $("#bireysel").show();

            } else if (tip == "PRIVATE_COMPANY") {

                $("#kurumsal").show();
                $("#bireysel").hide();

            }
        }).change()
    });
</script>