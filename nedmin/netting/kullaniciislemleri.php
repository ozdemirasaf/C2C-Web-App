<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// ob_start();
// session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'baglan.php';
require_once '../production/fonksiyon.php';


if (isset($_POST['musteriKaydet'])) {

    $kullanici_ad = htmlspecialchars($_POST['kullad']);
    $kullanici_soyad = htmlspecialchars($_POST['kullsoyad']);

    $kullanici_mail = htmlspecialchars($_POST['kullmail']);

    $kullanici_passwordone = htmlspecialchars(trim($_POST['passwordone']));

    $kullanici_passwordtwo = htmlspecialchars(trim($_POST['passwordtwo']));



    if ($kullanici_passwordone == $kullanici_passwordtwo) {


        if (strlen($kullanici_passwordone) >= 6) {



            // Başlangıç

            $kullanicisor = $db->prepare("select * from kullanici where kullanici_mail=:mail");
            $kullanicisor->execute(array(
                'mail' => $kullanici_mail
            ));

            //dönen satır sayısını belirtir
            $say = $kullanicisor->rowCount();



            if ($say == 0) {

                //md5 fonksiyonu şifreyi md5 şifreli hale getirir.
                $password = md5($kullanici_passwordone);

                $kullanici_yetki = 1;

                //Kullanıcı kayıt işlemi yapılıyor...
                $kullanicikaydet = $db->prepare("INSERT INTO kullanici SET
					kullanici_ad=:kullanici_ad,
					kullanici_soyad=:kullanici_soyad,
					kullanici_mail=:kullanici_mail,
					kullanici_password=:kullanici_password,
					kullanici_yetki=:kullanici_yetki
					");
                $insert = $kullanicikaydet->execute(array(
                    'kullanici_ad' => $kullanici_ad,
                    'kullanici_soyad' => $kullanici_soyad,
                    'kullanici_mail' => $kullanici_mail,
                    'kullanici_password' => $password,
                    'kullanici_yetki' => $kullanici_yetki
                ));

                if ($insert) {


                    header("Location:../../login?durum=loginbasarili");


                    //Header("Location:../production/genel-ayarlar.php?durum=ok");

                } else {


                    header("Location:../../register?durum=basarisiz");
                }
            } else {

                header("Location:../../register.php?durum=mukerrerkayit");
            }




            // Bitiş



        } else {


            header("Location:../../register.php?durum=eksiksifre");
        }
    } else {



        header("Location:../../register.php?durum=farklisifre");
    }
}



if (isset($_POST['musterigiris'])) {


    echo  $kullanici_mail = htmlspecialchars($_POST['kullmail']);
    echo "<br>";
    echo $kullanici_password = md5($_POST['password']);



    $kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail AND kullanici_password=:pass AND kullanici_yetki=:yetki AND kullanici_durum=:durum");

    $kullanicisor->execute(array(
        'mail' => $kullanici_mail,
        'yetki' => 1,
        'pass' => $kullanici_password,
        'durum' => 1
    ));

    // $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

    $say = $kullanicisor->rowCount();

    print_r($say);


    if ($say == 1) {

        echo $_SESSION['musterikullanici_mail'] = $kullanici_mail;

        header("Location:../../index?durum=girisBasarili");
        exit;
    } else {
        header("Location:../../login?durum=basarisizgiris");
        exit;
    }
}


if (isset($_POST['kullaniciBilgiGuncelle'])) {

    $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
    kullanici_ad=:ad,
    kullanici_soyad=:soyad,
    kullanici_gsm=:gsm
    WHERE kullanici_id=:id");

    $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
        'ad' => htmlspecialchars($_POST['kullAd']),
        'soyad' => htmlspecialchars($_POST['kullSoyad']),
        'gsm' => htmlspecialchars($_POST['kullGsm']),
        'id' => $_SESSION['kullaniciID']
    ));

    if ($kullBilgiGuncelle) {
        header("location:../../hesabim.php?durum=bilgiGuncellendi");
        exit;
    } else {
        header("location:../../hesabim.php?durum=bilgiGuncellenemedi");
        exit;
    }
}


if (isset($_POST['kullaniciAdresGuncelle'])) {

    $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
    kullanici_tip=:tip,
    kullanici_tc=:tc,
    kullanici_unvan=:unvan,
    kullanici_vdaire=:vdaire,
    kullanici_vno=:vno,
    kullanici_il=:il,
    kullanici_ilce=:ilce,
    kullanici_adres=:adres
    WHERE kullanici_id=:id");

    $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
        'tip' => htmlspecialchars($_POST['kullTip']),
        'tc' => htmlspecialchars($_POST['kulTc']),
        'unvan' => htmlspecialchars($_POST['firmaUnvan']),
        'vdaire' => htmlspecialchars($_POST['firmaVDaire']),
        'vno' => htmlspecialchars($_POST['firmaVno']),
        'il' => htmlspecialchars($_POST['sehir']),
        'ilce' => htmlspecialchars($_POST['sehirIlce']),
        'adres' => htmlspecialchars($_POST['acikAdres']),
        'id' => $_SESSION['kullaniciID']
    ));

    if ($kullBilgiGuncelle) {
        header("location:../../adresDuzenle.php?durum=bilgiGuncellendi");
        exit;
    } else {
        header("location:../../adresDuzenle?durum=bilgiGuncellenemedi");
        exit;
    }
}


if (isset($_POST['musteriSifreGuncelle'])) {


    $passwordEski = htmlspecialchars($_POST['passwordEski']);
    $passwordOne = htmlspecialchars($_POST['passwordOne']);
    $passwordTwo = htmlspecialchars($_POST['passwordTwo']);

    $password = md5($passwordEski);


    $kullaniciSor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_password=:pass");

    $kullaniciSor->execute(array(
        'pass' =>  $password
    ));

    $say = $kullaniciSor->rowCount();

    if ($say == 0) {
        header("location:../../sifreGuncelle.php?durum=eskiSifreYanlis");
        exit;
    }

    if ($passwordOne == $passwordTwo) {

        if (strlen($passwordOne) >= 6) {

            $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
            kullanici_password=:pass
            WHERE kullanici_id=:id");

            $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
                'pass' => md5($passwordOne),
                'id' => $_SESSION['kullaniciID']
            ));

            if ($kullBilgiGuncelle) {
                header("location:../../adresDuzenle.php?durum=sifreGuncellendi");
                exit;
            } else {
                header("location:../../adresDuzenle?durum=sifreGuncellenemedi");
                exit;
            }
        } else {
            header("location:../../sifreGuncelle.php?durum=sifrenizinKarakterSayisiAz");
            exit;
        }
    } else {
        header("location:../../sifreGuncelle.php?durum=yeniSifrelerAyniDegil");
        exit;
    }
}




if (isset($_POST['kullaniciMagzaBasvuru'])) {

    $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
    kullanici_ad=:ad,
    kullanici_soyad=:soyad,
    kullanici_gsm=:gsm,
    kullanici_banka=:bankaadi,
    kullanici_iban=:iban,
    kullanici_tip=:tip,
    kullanici_tc=:tc,
    kullanici_unvan=:unvan,
    kullanici_vdaire=:vdaire,
    kullanici_vno=:vno,
    kullanici_il=:il,
    kullanici_ilce=:ilce,
    kullanici_adres=:adres,
    kullanici_magaza=:magza
    WHERE kullanici_id=:id");

    $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
        'ad' => htmlspecialchars($_POST['kullAd']),
        'soyad' => htmlspecialchars($_POST['kullSoyad']),
        'gsm' => htmlspecialchars($_POST['bankaAdi']),
        'bankaadi' => htmlspecialchars($_POST['kullGsm']),
        'iban' => htmlspecialchars($_POST['bankaIban']),
        'tip' => htmlspecialchars($_POST['kullTip']),
        'tc' => htmlspecialchars($_POST['kulTc']),
        'unvan' => htmlspecialchars($_POST['firmaUnvan']),
        'vdaire' => htmlspecialchars($_POST['firmaVDaire']),
        'vno' => htmlspecialchars($_POST['firmaVno']),
        'il' => htmlspecialchars($_POST['sehir']),
        'ilce' => htmlspecialchars($_POST['sehirIlce']),
        'adres' => htmlspecialchars($_POST['acikAdres']),
        'magza' => 1,
        'id' => $_SESSION['kullaniciID']
    ));

    if ($kullBilgiGuncelle) {
        header("location:../../magza.php?durum=bilgiGuncellendi");
        exit;
    } else {
        header("location:../../magza?durum=bilgiGuncellenemedi");
        exit;
    }
}

// Ürün Resim, Ürün bilgiler Ekleme

if (isset($_POST['mazagaUrunEkle'])) {


    if ($_FILES['urunfoto_resimyol']['size'] > 1048576) {

        echo "Bu dosya boyutu çok büyük";

        Header("Location:../../urun-ekle.php?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');

    //echo $_FILES['ayar_logo']["name"];

    $ext = strtolower(substr($_FILES['urunfoto_resimyol']["name"], strpos($_FILES['urunfoto_resimyol']["name"], '.') + 1));

    if (in_array($ext, $izinli_uzantilar) === false) {
        echo "Bu uzantı kabul edilmiyor";
        Header("Location:../../urun-ekle.php?durum=formathata");
        exit;
    }

    @$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
    @$name = $_FILES['urunfoto_resimyol']["name"];


    include('../SimpleImage/SimpleImage.php');
    $image = new SimpleImage();
    $image->load($tmp_name);
    $image->resize(829, 422);
    $image->save($tmp_name);


    $uploads_dir = '../../dimg/urunFoto';


    $benzersizsayi4 = uniqid();
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . "." . $ext;

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");


    $duzenle = $db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		kullanici_id=:kullanici_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_stok=:urun_stok,
		urunfoto_resimyol=:urunfoto_resimyol
        ");
    $update = $duzenle->execute(array(
        'kategori_id' => htmlspecialchars($_POST['kategori_id']),
        'kullanici_id' => htmlspecialchars($_SESSION['kullaniciID']),
        'urun_ad' => htmlspecialchars($_POST['urun_ad']),
        'urun_detay' => htmlspecialchars($_POST['urun_detay']),
        'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
        'urun_stok' => htmlspecialchars($_POST['urun_stok']),
        'urunfoto_resimyol' => $refimgyol
    ));



    if ($update) {

        unlink("../../$resimsilunlink");

        Header("Location:../../urunlerim.php?durum=ok");
    } else {

        Header("Location:../../urun-ekle.php.php?durum=no");
    }
}
