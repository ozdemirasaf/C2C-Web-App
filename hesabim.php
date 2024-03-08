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


                <form class="form-horizontal" id="personal-info-form" action="nedmin/netting/kullaniciislemleri.php" method="post">

                    <div class="settings-details tab-content">

                        <div class="tab-pane fade active in" id="Personal">

                            <h2 class="title-section">Hesap Bilgileri Düzenle</h2>

                            <div class="personal-info inner-page-padding">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mail</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" disabled value="<?php echo $kullanicicek['kullanici_mail'] ?>" type="text">
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
                                    <div class="col-sm-12" align="right">
                                        <button type="submit" name="kullaniciBilgiGuncelle" class="update-btn" id="login-update">Bilgileri Güncelle</button>
                                    </div>
                                </div>
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