<?php
require_once 'header.php';

// Ürün bilgilerini çekkildiği yer


$urunSor = $db->prepare("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_id=:id AND urun_durum=:durum ORDER BY urun_zaman DESC");

$urunSor->execute(array(
    'id' => $_GET['urun_id'],
    'durum' => 1
));

$uruncek = $urunSor->fetch(PDO::FETCH_ASSOC);

// Bitti
?>



<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>

            </ul>
        </div>
    </div>
</div>


<div class="product-details-page bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
                    </div>

                    <div class="product-details-tab-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="product-details-title">
                                    <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">Açıklama</a></li>
                                    <li><a href="#review" data-toggle="tab" aria-expanded="false">Yorumlar</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="description">
                                        <p><?php echo $uruncek['urun_detay']  ?></p>
                                    </div>
                                    <div class="tab-pane fade" id="review">


                                        <div class="container">

                                            <div class="row">

                                                <div class="col-md-8">

                                                    <div class="comments-list">

                                                        <?php

                                                        // Yorumları ve puanları çekildiği kod parçası


                                                        $yorumSor = $db->prepare("SELECT yorumlar.*,kullanici.* FROM yorumlar INNER JOIN kullanici ON yorumlar.kullanici_id=kullanici.kullanici_id WHERE urun_id=:id order by yorum_zaman DESC");
                                                        $yorumSor->execute(array(
                                                            'id' =>  $_GET['urun_id']
                                                        ));

                                                        if (!$yorumSor->rowCount()) {
                                                            echo "Bu Ürüne Henüz Yorum Yapılmamıştır";
                                                        }


                                                        while ($yorumCek = $yorumSor->fetch(PDO::FETCH_ASSOC)) {

                                                            // bitti
                                                        ?>

                                                            <div class="media">

                                                                <div class="media-body">

                                                                    <h4 class="media-heading user_name"><img style="border-radius: 30px; float: left; margin-right: 10px; width: 32px; height: 32px;" class="img-responsive" src="<?php echo $yorumCek['kullanici_magazafoto'] ?>" alt="alt resim">
                                                                        <?php echo $yorumCek['kullanici_ad'] ?> <ul style="float: right;" class="default-rating">

                                                                            <?php
                                                                            // Puan ayarları

                                                                            switch ($yorumCek['yorum_puan']) {
                                                                                case '5':
                                                                            ?>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                <?php
                                                                                    break;

                                                                                case '4':
                                                                                ?>

                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                <?php
                                                                                    break;

                                                                                case '3':
                                                                                ?>

                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>

                                                                                <?php
                                                                                    break;
                                                                                case '2':
                                                                                ?>

                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>

                                                                                <?php
                                                                                    break;
                                                                                case '1':
                                                                                ?>

                                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                                                                    <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>

                                                                            <?php
                                                                            }
                                                                            ?>








                                                                            <li>(<span> <?php echo $yorumCek['yorum_puan'] ?></span> )</li>
                                                                        </ul>
                                                                    </h4>
                                                                    <?php echo $yorumCek['yorum_detay'] ?>
                                                                </div>


                                                            </div>
                                                            <hr>
                                                        <?php } ?>
                                                    </div>


                                                </div>


                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title"><?php echo $uruncek['urun_ad'] ?></h3>
                            <ul class="sidebar-product-price">
                                <li><?php echo $uruncek['urun_fiyat'] ?> ₺</li>
                            </ul>

                            <br>
                            <br>
                            <br>

                            <form action="odeme" method="post">

                                <ul class="sidebar-product-btn">

                                    <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">


                                    <?php
                                    if (empty($_SESSION['kullaniciID'])) { ?>

                                        <a class="add-to-cart-btn" id="cart-button"><i class="fa fa-ban" aria-hidden="true"></i> Giriş Yapın</a>

                                    <?php
                                    } else if ($_SESSION['kullaniciID'] == $uruncek['kullanici_id']) { ?>


                                        <a class="add-to-cart-btn" id="cart-button"><i class="fa fa-ban" aria-hidden="true"></i> Kendi Ürünün</a>

                                    <?php
                                    } else {
                                    ?>
                                        <button type="submit" class="add-to-cart-btn" id="cart-button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Satın Al</button>
                                    <?php
                                    }
                                    ?>


                                </ul>
                            </form>
                        </div>
                    </div>

                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <ul class="sidebar-sale-info">
                                <li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                                <li><?php

                                    // Bu ID üründen Kaç Kişi Satın Alındığını Gösteren kod parçası

                                    $urunSay = $db->prepare("SELECT COUNT(urun_id) AS say FROM siparis_detay WHERE urun_id=:id");

                                    $urunSay->execute(array(
                                        'id' => $_GET['urun_id']
                                    ));


                                    $saycek = $urunSay->fetch(PDO::FETCH_ASSOC);

                                    echo $saycek['say'];


                                    // Bitti



                                    ?></li>
                                <li>Satılan</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Satıcı Profil ayarı Belirtme -->

                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <img style="width: 73px; height: 63px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                                <div class="sidebar-author-content">
                                    <h3><?php echo $uruncek['kullanici_ad'] ?></h3>
                                    <a href="user.php?kullId=<?php echo $uruncek['kullanici_id'] ?>" class="view-profile">Profili İncele</a>
                                </div>
                            </div>

                            <?php

                            // Burada satıcının sattığı ürün kadar rütbe çıkarmaya yarayan kod parçası

                            $urunSay = $db->prepare("SELECT COUNT(kullanici_idsatici) AS say FROM siparis_detay WHERE kullanici_idsatici=:id");

                            $urunSay->execute(array(
                                'id' => $uruncek['kullanici_id']
                            ));


                            $saycek = $urunSay->fetch(PDO::FETCH_ASSOC);

                            ?>


                            <?php
                            if ($saycek['say'] > 1 && $saycek['say'] <= 9) {
                            ?>
                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>

                            <?php } else if ($saycek['say'] > 10 && $saycek['say'] <= 100) {
                            ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>

                            <?php } else if ($saycek['say'] > 100 && $saycek['say'] <= 1000) {
                            ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>

                            <?php } elseif ($saycek['say'] > 1000 && $saycek['say'] <= 10000) {
                            ?>

                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>

                            <?php } else if ($saycek['say'] > 10000 && $saycek['say'] <= 100000) {
                            ?>
                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>

                            <?php } ?>


                            <!-- Bitti -->


                        </div>
                    </div>

                    <!-- Bitti -->


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Details Page End Here -->
<?php require_once 'footer.php' ?>