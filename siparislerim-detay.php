<?php
require_once 'header.php';

islemkontrol();
?>

<head>
    <style>
        input {
            margin-left: 30px !important;
        }
    </style>
</head>

<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">

    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">



                <div class="settings-details tab-content">

                    <div class="tab-pane fade active in" id="Personal">

                        <h2 class="title-section"><?php echo $_GET['siparisId'] ?> numaralı sipariş detayı</h2>

                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Ürün Adı</th>
                                        <th scope="col">Satıcı</th>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">Onay Durum</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $siparissor = $db->prepare("SELECT urun.*,kullanici.*,siparis.*,siparis_detay.* FROM  siparis INNER JOIN siparis_detay ON
                                    siparis.siparis_id=siparis_detay.siparis_id INNER JOIN urun ON urun.urun_id=siparis_detay.urun_id INNER JOIN kullanici ON
                                    kullanici.kullanici_id=siparis_detay.kullanici_idsatici WHERE siparis.siparis_id=:siparisId");

                                    $siparissor->execute(array(
                                        'siparisId' => $_GET['siparisId']
                                    ));

                                    $say = 1;
                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {

                                        $siparisdetay_onay = $sipariscek['siparisdetay_siparisdetay_onay'];
                                        $yorumonay = $sipariscek['siparisdetay_yorumonay'];
                                        $urun_id = $sipariscek['urun_id'];
                                        $siparis_id = $sipariscek['siparis_id'];

                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $say++ ?></th>
                                            <td><?php echo $sipariscek['urun_ad'] ?></td>
                                            <td><?php echo $sipariscek['kullanici_ad'] ?></td>
                                            <td><?php echo $sipariscek['urun_fiyat'] ?></td>
                                            <td>
                                                <?php
                                                if ($sipariscek['siparisdetay_siparisdetay_onay'] == 1) {
                                                ?>
                                                    <a onclick="return confrim('Ürüne Onay Veriyorsunuz Bu işlem Geri Alınamaz!!')" href="nedmin/netting/kullaniciislemleri.php?urunonay=ok&urundetayId=<?php echo $sipariscek['siparisdetay_id'] ?>&urunId=<?php echo $sipariscek['siparis_id'] ?>"><button class="btn btn-warning btn-xs">Onayla</button></a>
                                                <?php
                                                } else if ($sipariscek['siparisdetay_siparisdetay_onay'] == 2) {
                                                ?>
                                                    <button class="btn btn-success btn-xs">Onaylandı</button>
                                                <?php
                                                } else if ($sipariscek['siparisdetay_siparisdetay_onay'] == 0) {
                                                ?>
                                                    <button class="btn btn-danger btn-xs">Teslim Edilmesini Bekliyor</button>
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

                            <?php

                            if ($siparisdetay_onay == 2 && $yorumonay == 0) {

                            ?>

                                <form class="form-horizontal" id="personal-info-form" action="nedmin/netting/kullaniciislemleri.php" method="post">

                                    <div class="settings-details tab-content">

                                        <div class="tab-pane fade active in" id="Personal">

                                            <h2 class="title-section">Yorum Yap & Puanla</h2>

                                            <div class="personal-info inner-page-padding">


                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Puan Yap</label>
                                                    <div class="col-sm-9">
                                                        <input type="radio" name="yorum_puan" value="1"> 1
                                                        <input type="radio" name="yorum_puan" value="2"> 2
                                                        <input type="radio" name="yorum_puan" value="3"> 3
                                                        <input type="radio" name="yorum_puan" value="4"> 4
                                                        <input type="radio" name="yorum_puan" value="5"> 5
                                                    </div>
                                                </div>

                                                <input type="hidden" name="urun_id" value="<?php echo $urun_id ?>">
                                                <input type="hidden" name="siparis_id" value="<?php echo $siparis_id ?>">

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Yorum Yap</label>
                                                    <div class="col-sm-9">
                                                        <textarea class="form-group" name="yorum_detay" cols="50" rows="5" required placeholder="Yorumunu Buraya Belirte Bilirsin"></textarea>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-sm-12" align="right">
                                                        <button type="submit" name="yorumPuanIslemleri" class="update-btn" id="login-update">Bilgileri Güncelle</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            <?php
                            } else if ($siparisdetay_onay == 2 && $yorumonay == 1) {
                            ?>
                                <p>Bu Ürün İçin Yorum ve Oylama Yapılmıştır</p>
                            <?php
                            }
                            ?>


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