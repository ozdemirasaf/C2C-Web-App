<?php
require_once 'header.php';

islemkontrol();
?>

<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.htm">Home</a><span> -</span></li>
                <li>Settings</li>
            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">

    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">




                <div class="settings-details tab-content">

                    <div class="tab-pane fade active in" id="Personal">

                        <h2 class="title-section">Adres Bilgileri Düzenle </h2>

                        <div class="personal-info inner-page-padding">

                            <?php

                            if ($kullanicicek["kullanici_magaza"] == 0) {
                            ?>
                                <form class="form-horizontal" id="personal-info-form" action="nedmin/netting/kullaniciislemleri.php" method="post">
                                    <p>Başvuru İşlemi Tamamlanması İçin Bilgileri Doğru ve Eksiksiz Bir Şekilde girilmesine Özen Gösterin.!</p>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mail</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" disabled value="<?php echo $kullanicicek['kullanici_mail'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Banka Adınız</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="bankaAdi" value="<?php echo $kullanicicek['kullanici_banka'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">IBAN Numaranız</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="bankaIban" value="<?php echo $kullanicicek['kullanici_iban'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Ad</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="kullAd" value="<?php echo $kullanicicek['kullanici_ad'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Soyad</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="last-name" name="kullSoyad" value="<?php echo $kullanicicek['kullanici_soyad'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Telefon Gsm</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="company-name" name="kullGsm" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" type="text">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">bireysel/Kurumsal</label>
                                        <div class="col-sm-9">
                                            <div class="custom-select">
                                                <select id="kullanici_tip" name="kullTip" class='select2'>
                                                    <option <?php
                                                            if ($kullanicicek['kullanici_tip'] == "PERSONAL") {
                                                                echo "selected";
                                                            }
                                                            ?> value="PERSONAL">Bireysel
                                                    <option <?php
                                                            if ($kullanicicek['kullanici_tip'] == "PRIVATE_COMPANY") {
                                                                echo "selected";
                                                            }
                                                            ?> value="PRIVATE_COMPANY">Kurumsal
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="bireysel">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">T.C</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="first-name" name="kulTc" value="<?php echo $kullanicicek['kullanici_tc'] ?>" type="text">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">İl</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="sehir" value="<?php echo $kullanicicek['kullanici_il'] ?>" type="text">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">İlçe</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="sehirIlce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Başvuru Onay</label>
                                        <div class="checkbox">
                                            <div class="col-sm-9">
                                                <label><input type="checkbox" required>Kullanım Şartlarını Kabul Ediyorum</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-12" align="right">
                                            <button type="submit" name="kullaniciMagzaBasvuru" class="update-btn" id="login-update">Bilgileri Güncelle</button>
                                        </div>
                                    </div>

                                </form>
                            <?php
                            } elseif ($kullanicicek["kullanici_magaza"] == 1) {
                            ?>
                                <p class="text-info"><strong>BİLGİ!</strong> Başvurunuz Onay Sürecinde...</p>
                                <p class="text-info">Başvurular genellikle 24 saat içersinde incelenir ve sonuçlanır.</p>

                            <?php
                            } else if ($kullanicicek["kullanici_magaza"] == 2) {
                            ?>
                                <p class="text-info"><strong>BİLGİ!</strong> Başvurunuz Onaylanmıştır..</p>
                                <p class="text-info">Mağzanızı yöneltmek için mağza yönetim bölümünden yönete bilirsiniz</p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php' ?>