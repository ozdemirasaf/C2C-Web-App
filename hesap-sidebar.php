<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
    <ul class="settings-title">
        <li class="active"><a href="javascript:void(0)"><b>ÜYE İŞLEMLERİ</b></a></li>
        <?php
        if ($kullanicicek["kullanici_magaza"] != 2) {
        ?>
            <li><a href="magza.php">Mağza Başvurusu</a></li>
        <?php
        }
        ?>
        <li><a href="hesabim.php">Siparişlerim</a></li>
        <li><a href="hesabim.php">Hesap Bilgilerim</a></li>
        <li><a href="resim-guncelle.php">Resim Güncelle</a></li>
        <li><a href="adresDuzenle.php">Adres-Bilgileri</a></li>
        <li><a href="sifreGuncelle.php">Şifre Güncelle</a></li>

    </ul>

    <?php
    if ($kullanicicek["kullanici_magaza"] == 2) {
    ?>

        <br>
        <br>
        <br>

        <ul class="settings-title">
            <li class="active"><a href="javascript:void(0)"><b>MAĞZA İŞLEMLERİ</b></a></li>
            <?php
            if ($kullanicicek["kullanici_magaza"] != 2) {
            ?>
                <li><a href="magza.php">Mağza Başvurusu</a></li>
            <?php
            }
            ?>
            <li><a href="urun-ekle.php">Ürün ekle</a></li>
            <li><a href="urunlerim.php">Ürünlerim</a></li>
            <li><a href="sifreGuncelle.php">Yeni Siparişlerim</a></li>
            <li><a href="sifreGuncelle.php">Tamamlanan Siparişler</a></li>
            <li><a href="sifreGuncelle.php">Mesajlar</a></li>
            <li><a href="sifreGuncelle.php">Ayarlar</a></li>

        </ul>
    <?php
    }
    ?>
</div>