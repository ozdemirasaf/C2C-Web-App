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
        <li><a href="siparislerim">Siparişlerim</a></li>
        <li><a href="hesabim">Hesap Bilgilerim</a></li>
        <li><a href="giden-mesajlar">Giden Mesajlar</a></li>
        <li><a href="gelen-mesajlar">Gelen Mesajlar</a></li>
        <li><a href="resim-guncelle">Resim Güncelle</a></li>
        <li><a href="adresDuzenle">Adres-Bilgileri</a></li>
        <li><a href="sifreGuncelle">Şifre Güncelle</a></li>

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
            <li><a href="urun-ekle">Ürün ekle</a></li>
            <li><a href="urunlerim">Ürünlerim</a></li>
            <li><a href="yeni-siparisler">Yeni Siparişlerim</a></li>
            <li><a href="tamamlanan-siparisler">Tamamlanan Siparişler</a></li>
            <li><a href="sifreGuncelle.php">Ayarlar</a></li>

        </ul>
    <?php
    }
    ?>
</div>