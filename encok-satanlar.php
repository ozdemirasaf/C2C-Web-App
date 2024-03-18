<div class="trending-products-area section-space-default">
    <div class="container">
        <h2 class="title-default">En Çok Satanlar</h2>
    </div>
    <div class="container=fluid">


        <div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">


            <?php
            error_reporting(E_ALL);
            ini_set("display_errors", 1);

            $encoksatansor = $db->prepare("SELECT COUNT(siparis_detay.urun_id) AS urunsay, urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN
            kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:durum GROUP BY siparis_detay.urun_id ORDER BY urunsay DESC LIMIT 8");

            $encoksatansor->execute(array(
                'durum' => 1
            ));

            while ($encoksatancek = $encoksatansor->fetch(PDO::FETCH_ASSOC)) {

            ?>


                <!-- En çok satanlar -->
                <div class="single-item-grid">
                    <div class="item-img">
                        <a href="urun-<?= seo($encoksatancek['urun_ad']) . "-" . $encoksatancek['urun_id'] ?>"><img src="<?php echo $encoksatancek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                        <div class="trending-sign" data-tips="Öne Çıkanlar"><i class="fa fa-bolt" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="item-content">
                        <div class="item-info">
                            <h3><a href="urun-<?= seo($encoksatancek['urun_ad']) . "-" . $encoksatancek['urun_id'] ?>"><?php echo $encoksatancek['urun_ad'] ?></a></h3>
                            <a href="kategoriler-<?= seo($encoksatancek['kategori_ad']) . "-" . $encoksatancek['kategori_id']; ?>"><span><?php echo $encoksatancek['kategori_ad'] ?></span></a>
                            <div class="price"><?php echo $encoksatancek['urun_fiyat'] ?> ₺</div>
                        </div>
                        <div class="item-profile">
                            <div class="profile-title">
                                <div class="img-wrapper"><img style="height: 38px; width: 38px;" src="<?php echo $encoksatancek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                <span><?php echo $encoksatancek['kullanici_ad'] . " " . $encoksatancek['kullanici_soyad']  ?></span>
                            </div>
                            <div class="profile-rating">
                                <ul>

                                    <a href="#"><b>Tüm Ürünleri</b></a>

                                    <!-- <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li>(<span> 05</span> )</li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <!-- En çok satanlar end -->



        </div>
    </div>
</div>