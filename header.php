<?php
// ob_start();
// session_start();

if (basename($_SERVER['PHP_SELF'])  == basename(__FILE__)) {

    exit("Burada Erişim Yapmanız Yasak !!");
}

date_default_timezone_set('Europe/Istanbul');

require_once 'nedmin/netting/baglan.php';
require_once 'nedmin/production/fonksiyon.php';
//Belirli veriyi seçme işlemi
$ayarsor = $db->prepare("SELECT * FROM ayar where ayar_id=:id");
$ayarsor->execute(array(
    'id' => 0
));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);


// Session olu ise kayittan atma kismi

if (isset($_SESSION['musterikullanici_mail'])) {

    $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array(
        'mail' => $_SESSION['musterikullanici_mail']
    ));
    $say = $kullanicisor->rowCount();
    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    // burada kullanici id'sini session'a alma kismi

    if (!isset($_SESSION['kullaniciID'])) {
        $_SESSION['kullaniciID'] = $kullanicicek['kullanici_id'];
    }
}


// Profil Online || Offline Kodları

$suan = time();

$fark = ($suan - $_SESSION['musterikullanici_sonzaman']);

if ($fark > 50) {

    $_SESSION['musterikullanici_sonzaman'] = strtotime(date("Y-m-d H:i:s"));


    $zamanguncelle = $db->prepare("UPDATE kullanici SET
    kullanici_sonzaman=:kullanici_sonzaman
    WHERE kullanici_id={$_SESSION['kullaniciID']}");

    $uptada = $zamanguncelle->execute(array(
        'kullanici_sonzaman' => date("Y-m-d H:i:s")
    ));
}

// Profil Online END

// Site Bakimi

if ($ayarcek['ayar_bakim'] == 1) {
    header("location:siteBakim/bakim");
    exit;
}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $ayarcek['ayar_description'] ?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords'] ?>">
    <meta name="author" content="<?php echo $ayarcek['ayar_author'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php
        if (empty($title)) {
            echo $ayarcek['ayar_title'];
        } else {
            $title;
        }
        ?>
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img\favicon.png">

    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css\normalize.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css\main.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css\bootstrap.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css\animate.min.css">

    <!-- Font-awesome CSS-->
    <link rel="stylesheet" href="css\font-awesome.min.css">

    <!-- Owl Caousel CSS -->
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.carousel.min.css">
    <link rel="stylesheet" href="vendor\OwlCarousel\owl.theme.default.min.css">

    <!-- Main Menu CSS -->
    <link rel="stylesheet" href="css\meanmenu.min.css">

    <!-- Datetime Picker Style CSS -->
    <link rel="stylesheet" href="css\jquery.datetimepicker.css">

    <!-- ReImageGrid CSS -->
    <link rel="stylesheet" href="css\reImageGrid.css">

    <!-- Switch Style CSS -->
    <link rel="stylesheet" href="css\hover-min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Modernizr Js -->
    <script src="js\modernizr-2.8.3.min.js"></script>


    <!-- Select2 CSS -->
    <link rel="stylesheet" href="css\select2.min.css">

    <!-- Ck Editör -->
    <script src="nedmin/production/ckeditor/ckeditor.js"></script>


</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    <!-- Preloader Start Here -->
    <!-- <div id="preloader"></div> -->
    <!-- Preloader End Here -->
    <!-- Main Body Area Start Here -->
    <div id="wrapper">
        <!-- Header Area Start Here -->
        <header>
            <div id="header2" class="header2-area right-nav-mobile">
                <div class="header-top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                <div class="logo-area">
                                    <a href="index"><img class="img-responsive" src="<?php echo $ayarcek['ayar_logo'] ?>" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                <ul class="profile-notification">
                                    <!-- <li>
                                        <div class="notify-contact"><span>Need help?</span> Talk to an expert: +61 3 8376 6284</div>
                                    </li> -->

                                    <?php
                                    if (isset($_SESSION['musterikullanici_mail'])) {
                                    ?>

                                        <li>
                                            <div class="notify-notification">
                                                <a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i><span>8</span></a>

                                                <ul>
                                                    <li>
                                                        <div class="notify-notification-img">
                                                            <img class="img-responsive" src="img\profile\1.png" alt="profile">
                                                        </div>
                                                        <div class="notify-notification-info">
                                                            <div class="notify-notification-subject">Need WP Help!</div>
                                                            <div class="notify-notification-date">01 Dec, 2016</div>
                                                        </div>
                                                        <div class="notify-notification-sign">
                                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="notify-notification-img">
                                                            <img class="img-responsive" src="img\profile\2.png" alt="profile">
                                                        </div>
                                                        <div class="notify-notification-info">
                                                            <div class="notify-notification-subject">Need HTML Help!</div>
                                                            <div class="notify-notification-date">01 Dec, 2016</div>
                                                        </div>
                                                        <div class="notify-notification-sign">
                                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="notify-notification-img">
                                                            <img class="img-responsive" src="img\profile\3.png" alt="profile">
                                                        </div>
                                                        <div class="notify-notification-info">
                                                            <div class="notify-notification-subject">Psd Template Help!</div>
                                                            <div class="notify-notification-date">01 Dec, 2016</div>
                                                        </div>
                                                        <div class="notify-notification-sign">
                                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li>

                                            <?php


                                            $mesajSay = $db->prepare("SELECT COUNT(mesaj_okunma) AS say FROM mesaj WHERE mesaj_okunma=:okunma AND mesaj_gel=:kullgel");

                                            $mesajSay->execute(array(
                                                'okunma' => 0,
                                                'kullgel' => $_SESSION['kullaniciID']
                                            ));


                                            $saycek = $mesajSay->fetch(PDO::FETCH_ASSOC);



                                            ?>

                                            <div class="notify-message">
                                                <a href="gelen-mesajlar"><i class="fa fa-envelope-o" aria-hidden="true"></i><span><?php echo $saycek["say"]; ?></span></a>
                                                <ul>

                                                    <?php

                                                    $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.mesaj_gon=kullanici.kullanici_id WHERE mesaj_gel=:id AND mesaj_okunma=:okunma ORDER BY mesaj_zaman DESC LIMIT 4");

                                                    $mesajsor->execute(array(
                                                        'id' => $_SESSION['kullaniciID'],
                                                        'okunma' => 0
                                                    ));
                                                    ?>

                                                    <?php
                                                    if ($mesajsor->rowCount() == 0) { ?>
                                                        <li>
                                                            <div class="notify-message-info">
                                                                <div class="notify-message-subject" style="color: black; font-family: sans-serif; font-size: 13px;">
                                                                    Hiç Mesajınız Bulunmamaktadır !
                                                                </div>
                                                            </div>
                                                        </li>

                                                    <?php }

                                                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {  ?>




                                                        <li>
                                                            <div class="notify-message-img">
                                                                <img class="img-responsive" style="height: 40px; width: 40px; border-radius: 30px;" src="<?php echo $mesajcek['kullanici_magazafoto'] ?>" alt="profile">
                                                            </div>
                                                            <div class="notify-message-info">
                                                                <div class="notify-message-sender"><?php echo $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad']  ?></div>
                                                                <div class="notify-message-subject"><?php echo mb_substr($mesajcek['mesaj_detay'], 0, 10, "UTF-8") ?></div>
                                                                <div class="notify-message-date"><?php echo $mesajcek['mesaj_zaman'] ?></div>
                                                            </div>
                                                            <div class="notify-message-sign">
                                                                <a href="mesaj-detay?mesajId=<?php echo $mesajcek['mesaj_id'] ?>&kullanicigon=<?php echo $mesajcek['mesaj_gon'] ?>"> <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                                            </div>
                                                        </li>

                                                    <?php } ?>

                                                </ul>
                                            </div>
                                        </li>
                                    <?php } ?>

                                    <?php

                                    if (isset($_SESSION['musterikullanici_mail'])) {
                                    ?>
                                        <li>
                                            <div class="user-account-info">
                                                <div class="user-account-info-controler">
                                                    <div class="user-account-img">
                                                        <img class="img-responsive" style="border-radius: 30px;" height="32" width="32" src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="profile">
                                                    </div>
                                                    <div class="user-account-title">
                                                        <div class="user-account-name"><?php echo $kullanicicek['kullanici_ad'] ?></div>
                                                        <div class="user-account-balance">

                                                            <?php

                                                            // Toplam Fiyat Hesaplama Kodları


                                                            $siparissor = $db->prepare("SELECT SUM(urun_fiyat) AS toplam FROM siparis_detay WHERE kullanici_idsatici=:kullanici_id");
                                                            $siparissor->execute(array(
                                                                'kullanici_id' => $_SESSION['kullaniciID']
                                                            ));

                                                            $sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC);


                                                            if (isset($sipariscek['toplam'])) {

                                                                echo $sipariscek['toplam'] . " " .  "₺";
                                                            } else {
                                                                echo 0;
                                                            }


                                                            ?>


                                                        </div>
                                                    </div>
                                                    <div class="user-account-dropdown">
                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                                <ul>
                                                    <li><a href="hesabim.php">Hesabı Bilgilerim</a></li>
                                                    <!-- <li><a href="#">Portfolio</a></li>
                                                    <li><a href="#">Account Setting</a></li>
                                                    <li><a href="#">Downloads</a></li>
                                                    <li><a href="#">Wishlist</a></li>
                                                    <li><a href="#">Upload Item</a></li>
                                                    <li><a href="#">Statement</a></li>
                                                    <li><a href="#">Withdraws</a></li> -->
                                                </ul>
                                            </div>
                                        <li><a class="apply-now-btn" href="logout.php" id="logout-button">çıkış</a></li>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li> <a class="apply-now-btn hidden-on-mobile" href="login.php">Üye Giriş</a></li>

                                        <li><a class="apply-now-btn-color hidden-on-mobile" href="register.php">Kayıt</a></li>
                                    <?php
                                    }
                                    ?>





                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-menu-area bg-primaryText" id="sticker">
                    <div class="container">
                        <nav id="desktop-nav">
                            <ul>
                                <li class="active"><a href="index">Anasayfa</a></li>
                                <li><a href="kategoriler">Kategoriler</a></li>

                                <?php
                                $kategorisor = $db->prepare("SELECT * FROM kategori WHERE kategori_onecikar=:onecikar order by kategori_sira ASC");
                                $kategorisor->execute(array(
                                    'onecikar' => 1
                                ));

                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <li><a href="kategoriler-<?= seo($kategoricek['kategori_ad']) . "-" . $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>


            <!-- Mobile Menu Area Start -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>


                                        <li class="active"><a href="index">Anasayfa</a></li>

                                        <li><a href="login">Üye Giriş</a></li>

                                        <li><a href="register">Üye Kayıt</a></li>

                                        <li><a href="kategoriler">Kategoriler</a></li>

                                        <?php
                                        $kategorisor = $db->prepare("SELECT * FROM kategori WHERE kategori_onecikar=:onecikar order by kategori_sira ASC");
                                        $kategorisor->execute(array(
                                            'onecikar' => 1
                                        ));

                                        while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                        ?>

                                            <li><a href="kategoriler-<?= seo($kategoricek['kategori_ad']) . "-" . $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad'] ?></a></li>
                                        <?php } ?>



                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area End -->
        </header>