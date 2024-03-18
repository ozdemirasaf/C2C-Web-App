<?php require_once 'header.php' ?>


<!-- Main Banner 1 Area End Here -->
<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>

            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom" id="table" style="display: block;">
    <div class="container">
        <h2 class="title-section">Üye Kayıt İşlemleri</h2>
        <div class="registration-details-area inner-page-padding">
            <?php
            if ($_GET['durum'] == "farklisifre") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
                </div>

            <?php } elseif ($_GET['durum'] == "eksiksifre") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
                </div>

            <?php } elseif ($_GET['durum'] == "mukerrerkayit") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
                </div>

            <?php } elseif ($_GET['durum'] == "basarisiz") { ?>

                <div class="alert alert-danger">
                    <strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
                </div>

            <?php }
            ?>


            <form action="nedmin/netting/kullaniciislemleri.php" method="post" id="personal-info-form">

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="mail">Mailiniz *</label>
                            <input type="email" id="mail" name="kullmail" class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="passone">Şifreniz *</label>
                            <input type="password" id="passone" name="password" class="form-control">
                        </div>
                    </div>
                </div>

                <!-- ***** Captcha Islemleri ***** -->

                <div class="row">

                    <!-- ***** Captcha Guvenlik Resmi Goruntuleme ***** -->


                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="mail">Güvenlik Kodu</label>
                            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image">
                            <a onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[Random Değiştir]</a>
                        </div>
                    </div>

                    <!-- ***** Captcha Guvenlik Resmi Goruntuleme BİTTİ ***** -->


                    <!-- ***** Captcha Guvenlik Resmi Kodunu Yazma ***** -->


                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="form-group">
                            <label class="control-label" for="passone">Güvenlik Kodu Giriniz *</label>
                            <input type="text" id="passone" name="captcha_code" placeholder="Güvenlik Kodunu Yanınız" class="form-control">
                        </div>
                    </div>


                    <!-- ***** Captcha Guvenlik Resmi Kodunu Yazma BİTTİ ***** -->


                </div>

                <!-- ***** Captcha Islemleri Bittimi ***** -->



                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pLace-order">
                            <button class="update-btn disabled" type="submit" name="musterigiris">Gönder</button>
                            <button type="button" onclick="sifreUnuttumBtn(1)" class="btn btn-danger" id="">Şifremi Unuttum</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<!-- Şifre Unuttum Yapmak İçin Dipnot Oku !! -->

<!-- ***** Sifremi Unuttum Modali ***** -->

<div class="registration-page-area bg-secondary section-space-bottom" id="sifreunuttum" style="display: none;">
    <div class="container">
        <h2 class="title-section">Şifre Unuttum</h2>
        <div class="registration-details-area inner-page-padding">



            <form action="nedmin/netting/kullaniciislemleri.php" method="post" id="personal-info-form">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <p>
                                Sistemdeki Kayıtlı Malinizi Giriniz Şifreniz Oraya Gelecektir
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label" for="mail">Kayitli Olan Mail Adresi *</label>
                            <input type="email" id="mail" name="mail_adres" class="form-control">
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pLace-order">

                            <button id="sifrebtngeri" onclick="sifreUnuttumBtn(2)" class="update-btn disabled" type="button">Geri</button>

                            <button class="update-btn disabled" type="submit" name="musterigiris">Gönder</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

</div>




<!-- ***** Sifremi Unuttum Modali BİTTİ ***** -->


<?php require_once 'footer.php' ?>

<script>
    // birinci div'i Kapatıp İkinci div'i açan Kod

    function sifreUnuttumBtn(e) {
        var div1 = document.getElementById("table");
        var div2 = document.getElementById("sifreunuttum");


        console.log(e);

        if (e == 1) {
            div1.style.display = "none";
            div2.style.display = "block";

        } else if (e == 2) {
            div1.style.display = "block";
            div2.style.display = "none";
        }


    }



    // sifreBtn.addEventListener("click", function() {



    // })
</script>