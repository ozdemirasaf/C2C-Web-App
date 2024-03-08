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

                        <h2 class="title-section">Ürünleriniz</h2>

                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ürün Tarih</th>
                                        <th scope="col">Ürün Ad</th>
                                        <th scope="col">Ürünü Kaldır</th>
                                        <th scope="col">Ürünü Düzenle</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $urunsor = $db->prepare("SELECT * FROM urun WHERE kullanici_id=:kullanici_id order by urun_zaman DESC");
                                    $urunsor->execute(array(
                                        'kullanici_id' => $_SESSION['kullaniciID']
                                    ));
                                    $say = 1;
                                    while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {

                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $say++ ?></th>
                                            <td><?php echo $uruncek['urun_zaman'] ?></td>
                                            <td><?php echo $uruncek['urun_ad'] ?></td>
                                            <td>
                                                <?php
                                                if ($uruncek['urun_durum'] == 0) {
                                                ?>
                                                    <center><a href="urun-duzenle.php?urunID=<?php echo $uruncek['urun_id'] ?>"><button class="btn btn-warning btn-xs">Onay Bekliyor..</button></a></center>
                                                <?php
                                                } else {
                                                ?>
                                                    <center><a onclick="return confirm('Bu Ürünü Silmek İstiyormunuz')" href="nedmin/netting/adminislem.php?durum=ok&urunID=<?php echo $uruncek['urun_id'] ?>&urunResim=<?php echo $uruncek['urunfoto_resimyol'] ?>"><button class="btn btn-danger btn-xs">Kaldır</button></a></center>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <center><a href="urun-duzenle.php?urunID=<?php echo $uruncek['urun_id'] ?>"><button class="btn btn-success btn-xs">Düzenle</button></a></center>
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