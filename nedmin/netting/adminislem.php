<?php
ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';





if (isset($_POST['logoduzenle'])) {






    if ($_FILES['ayar_logo']['size'] > 1048576) {

        echo "Bu dosya boyutu çok büyük";

        Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');

    //echo $_FILES['ayar_logo']["name"];

    $ext = strtolower(substr($_FILES['ayar_logo']["name"], strpos($_FILES['ayar_logo']["name"], '.') + 1));

    if (in_array($ext, $izinli_uzantilar) === false) {
        echo "Bu uzantı kabul edilmiyor";
        Header("Location:../production/genel-ayar.php?durum=formathata");

        exit;
    }


    $uploads_dir = '../../dimg';

    @$tmp_name = $_FILES['ayar_logo']["tmp_name"];
    @$name = $_FILES['ayar_logo']["name"];

    $benzersizsayi4 = rand(20000, 32000);
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . $name;

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");


    $duzenle = $db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
    $update = $duzenle->execute(array(
        'logo' => $refimgyol
    ));



    if ($update) {

        $resimsilunlink = $_POST['eski_yol'];
        unlink("../../$resimsilunlink");

        Header("Location:../production/genel-ayar.php?durum=ok");
    } else {

        Header("Location:../production/genel-ayar.php?durum=no");
    }
}




if (isset($_POST['adminKullaniciDuzenle'])) {

    echo $kullId = $_POST['kullid'];

    $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
    kullanici_ad=:ad,
    kullanici_soyad=:soyad,
    kullanici_gsm=:gsm,
    kullanici_tc=:tc,
    kullanici_il=:il,
    kullanici_ilce=:ilce,
    kullanici_adres=:adres,
    kullanici_durum=:durum
    WHERE kullanici_id=:id");

    $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
        'ad' => htmlspecialchars($_POST['kullanici_ad']),
        'soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'gsm' => htmlspecialchars($_POST['kullanici_gsm']),
        'tc' => htmlspecialchars($_POST['kullanici_tc']),
        'il' => htmlspecialchars($_POST['sehirIl']),
        'ilce' => htmlspecialchars($_POST['sehirIlce']),
        'adres' => htmlspecialchars($_POST['sehirAdres']),
        'durum' => htmlspecialchars($_POST['kullanici_durum']),
        'id' => $kullId
    ));

    if ($kullBilgiGuncelle) {
        header("location:../production/kullanici.php?durum=bilgiGuncellendi");
        exit;
    } else {
        header("location:../production/kullanici.php?durum=bilgiGuncellenemedi");
        exit;
    }
}



if ($_GET['magazaOnay'] == "iptal") {


    echo $kullId = $_GET['kullaniciID'];

    $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
    kullanici_magaza=:kullanici_magaza
    WHERE kullanici_id=:id");

    $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
        'kullanici_magaza' => 0,
        'id' => $kullId
    ));

    if ($kullBilgiGuncelle) {
        header("location:../production/magaza-basvuru.php?durum=bilgiGuncellendi");
        exit;
    } else {
        header("location:../production/magaza-basvuru.php?durum=bilgiGuncellenemedi");
        exit;
    }
}


if (isset($_POST['magazaonaykaydet'])) {

    $kullId = $_POST['kullid'];

    $kullBilgileriSor = $db->prepare("UPDATE kullanici SET
        kullanici_ad=:kullanici_ad,
        kullanici_soyad=:kullanici_soyad,
        kullanici_gsm=:kullanici_gsm,
        kullanici_banka=:kullanici_banka,
        kullanici_iban=:kullanici_iban,
        kullanici_tc=:kullanici_tc,
        kullanici_unvan=:kullanici_unvan,
        kullanici_vdaire=:kullanici_vdaire,
        kullanici_vno=:kullanici_vno,
        kullanici_il=:kullanici_il,
        kullanici_ilce=:kullanici_ilce,
        kullanici_adres=:kullanici_adres,
        kullanici_magaza=:kullanici_magaza
        WHERE kullanici_id=:id");

    $kullBilgiGuncelle = $kullBilgileriSor->execute(array(
        'kullanici_ad' => htmlspecialchars($_POST['kullanici_ad']),
        'kullanici_soyad' => htmlspecialchars($_POST['kullanici_soyad']),
        'kullanici_gsm' => htmlspecialchars($_POST['kullanici_gsm']),
        'kullanici_banka' => htmlspecialchars($_POST['kullanici_banka']),
        'kullanici_iban' => htmlspecialchars($_POST['kullanici_iban']),
        'kullanici_tc' => htmlspecialchars($_POST['kullanici_tc']),
        'kullanici_unvan' => htmlspecialchars($_POST['kullanici_unvan']),
        'kullanici_vdaire' => htmlspecialchars($_POST['kullanici_vdaire']),
        'kullanici_vno' => htmlspecialchars($_POST['kullanici_vno']),
        'kullanici_il' => htmlspecialchars($_POST['kullanici_il']),
        'kullanici_ilce' => htmlspecialchars($_POST['kullanici_ilce']),
        'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres']),
        'kullanici_magaza' => 2,
        'id' => $kullId
    ));

    if ($kullBilgiGuncelle) {
        header("location:../production/magazalar.php?durum=bilgiGuncellendi");
        exit;
    } else {
        header("location:../production/magazalar.php?durum=bilgiGuncellenemedi");
        exit;
    }
}



if (isset($_POST['musteriProfilGuncelle'])) {


    if ($_FILES['kullanici_magazafoto']['size'] > 1048576) {

        echo "Bu dosya boyutu çok büyük";

        Header("Location:../../resim-guncelle.php?durum=dosyabuyuk");
    }


    $izinli_uzantilar = array('jpg', 'png');

    //echo $_FILES['ayar_logo']["name"];

    $ext = strtolower(substr($_FILES['kullanici_magazafoto']["name"], strpos($_FILES['kullanici_magazafoto']["name"], '.') + 1));

    if (in_array($ext, $izinli_uzantilar) === false) {
        echo "Bu uzantı kabul edilmiyor";
        Header("Location:../../resim-guncelle.php?durum=formathata");
        exit;
    }

    @$tmp_name = $_FILES['kullanici_magazafoto']["tmp_name"];
    @$name = $_FILES['kullanici_magazafoto']["name"];


    include('../SimpleImage/SimpleImage.php');
    $image = new SimpleImage();
    $image->load($tmp_name);
    $image->resize(128, 128);
    $image->save($tmp_name);


    $uploads_dir = '../../dimg/userPhoto';


    $benzersizsayi4 = uniqid();
    $refimgyol = substr($uploads_dir, 6) . "/" . $benzersizsayi4 . "." . $ext;

    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");


    $duzenle = $db->prepare("UPDATE kullanici SET
		kullanici_magazafoto=:kullanici_magazafoto
		WHERE kullanici_id={$_SESSION['kullaniciID']}");
    $update = $duzenle->execute(array(
        'kullanici_magazafoto' => $refimgyol
    ));



    if ($update) {

        $resimsilunlink = $_POST['eskiYol'];
        unlink("../../$resimsilunlink");

        Header("Location:../../resim-guncelle.php?durum=ok");
    } else {

        Header("Location:../../resim-guncelle.php.php?durum=no");
    }
}



// Ürün ekleme işlemleri

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
        'urun_detay' => seo(htmlspecialchars($_POST['urun_detay'])),
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




// Ürün düzünleme işlemleri

if (isset($_POST['mazagaUrunDuzenle'])) {

    if ($_FILES["urunfoto_resimyol"]['size'] > 0) {


        if ($_FILES['urunfoto_resimyol']['size'] > 1048576) {

            echo "Bu dosya boyutu çok büyük";

            Header("Location:../../urun-duzenle.php?durum=dosyabuyuk");
        }


        $izinli_uzantilar = array('jpg', 'png');

        $ext = strtolower(substr($_FILES['urunfoto_resimyol']["name"], strpos($_FILES['urunfoto_resimyol']["name"], '.') + 1));

        if (in_array($ext, $izinli_uzantilar) === false) {
            echo "Bu uzantı kabul edilmiyor";
            Header("Location:../../urun-duzenle.php?durum=formathata");
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


        $duzenle = $db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_stok=:urun_stok,
		urunfoto_resimyol=:urunfoto_resimyol
        where urun_id=:urun_id");

        $update = $duzenle->execute(array(
            'kategori_id' => htmlspecialchars($_POST['kategori_id']),
            'urun_ad' => htmlspecialchars($_POST['urun_ad']),
            'urun_detay' => htmlspecialchars($_POST['urun_detay']),
            'urun_fiyat' => htmlspecialchars($_POST['urun_fiyat']),
            'urun_stok' => htmlspecialchars($_POST['urun_stok']),
            'urunfoto_resimyol' => $refimgyol,
            'urun_id' => $_POST['urun_id']
        ));


        if ($update) {
            $resimsilunlink = $_POST['eskiYol'];
            unlink("../../$resimsilunlink");

            Header("Location:../../urunlerim.php?durum=ok");
        } else {

            Header("Location:../../urunlerim.php?durum=no");
        }
    } else {
        // Eyerki Resim Yoksa Buraya Düşsün
        echo "burada";
    }
}



// Urunleri sil

if ($_GET['durum'] == "ok") {

    $sil = $db->prepare("DELETE from urun where urun_id=:urun_id");
    $kontrol = $sil->execute(array(
        'urun_id' => $_GET['urunID']
    ));

    if ($kontrol) {

        $resimsilunlink = $_GET['urunResim'];
        unlink("../../$resimsilunlink");

        Header("Location:../../urunlerim.php?durum=ok");
    } else {

        Header("Location:../../urunlerim.php?durum=no");
    }
}


// kategori Duzenle

if (isset($_POST['kategoriduzenle'])) {

    $kategori_id = $_POST['kategori_id'];
    $kategori_seourl = seo($_POST['kategori_ad']);


    $kaydet = $db->prepare("UPDATE kategori SET
		kategori_ad=:ad,
		kategori_durum=:kategori_durum,	
		kategori_seourl=:seourl,
		kategori_onecikar=:kategori_onecikar,
		kategori_sira=:sira
		WHERE kategori_id={$_POST['kategori_id']}");
    $update = $kaydet->execute(array(
        'ad' => $_POST['kategori_ad'],
        'kategori_durum' => $_POST['kategori_durum'],
        'kategori_onecikar' => $_POST['kategori_onecikar'],
        'seourl' => $kategori_seourl,
        'sira' => $_POST['kategori_sira']
    ));

    if ($update) {

        Header("Location:../production/kategori-duzenle.php?durum=ok&kategori_id=$kategori_id");
    } else {

        Header("Location:../production/kategori-duzenle.php?durum=no&kategori_id=$kategori_id");
    }
}
