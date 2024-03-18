<?php require_once 'header.php' ?>

<!-- Header Area End Here -->
<!-- Main Banner 1 Area Start Here -->

<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">
            <h1>C2C Alıcı ve Satıcıları Buluşturan Projemiz!</h1>
            <p>Aramak istediğiniz şeyi belirtin..</p>

            <form action="arama-detay" method="POST">

                <div class="banner-search-area input-group">

                    <input class="form-control" placeholder="Yazınız.." required minlength="3   " name="searchkeyword" type="text">

                    <span class="input-group-addon">

                        <button type="submit" name="searchSayfa">

                            <span class="glyphicon glyphicon-search"></span>

                        </button>

                    </span>
                </div>

            </form>

        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here -->
<!-- Newest Products Area Start Here -->
<div class="newest-products-area bg-secondary section-space-default">
    <div class="container">
        <h2 class="title-default">Öne Çıkan Ürünler</h2>
    </div>
    <div class="container-fluid" id="isotope-container">
        <div class="isotope-classes-tab isotop-box-btn-white">



        </div>
        <div class="row featuredContainer">

            <?php
            error_reporting(E_ALL);
            ini_set("display_errors", 1);

            $urunsor = $db->prepare("SELECT COUNT(siparis_detay.urun_id) AS urunsay, urun.*,kategori.*,kullanici.*,siparis_detay.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN
            kullanici ON urun.kullanici_id=kullanici.kullanici_id INNER JOIN siparis_detay ON siparis_detay.urun_id=urun.urun_id WHERE urun.urun_durum=:durum GROUP BY siparis_detay.urun_id ORDER BY urunsay DESC LIMIT 8");

            $urunsor->execute(array(
                'onecikar' => 1,
                'durum' => 1
            ));

            while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {

            ?>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wordpress yenigelen plugins">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Öne Çıkanlar"><i class="fa fa-bolt" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="item-info">
                                <h3><a href="urun-<?= seo($uruncek['urun_ad']) . "-" . $uruncek['urun_id'] ?>"><?php echo $uruncek['urun_ad'] ?></a></h3>
                                <a href="kategoriler-<?= seo($uruncek['kategori_ad']) . "-" . $uruncek['kategori_id']; ?>"><span><?php echo $uruncek['kategori_ad'] ?></span></a>
                                <div class="price"><?php echo $uruncek['urun_fiyat'] ?> ₺</div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">
                                    <div class="img-wrapper"><img style="height: 38px; width: 38px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                    <span><?php echo $uruncek['kullanici_ad'] . " " . $uruncek['kullanici_soyad']  ?></span>
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
                </div>

            <?php } ?>


        </div>
    </div>
</div>

<!-- En çok satanlar -->

<?php require_once 'encok-satanlar.php' ?>

<!-- En çok satanlar -->


<div class="why-choose-area bg-primaryText section-space-default">
    <div class="container">
        <h2 class="title-textPrimary">Why You Choose Foxtar Market Place?</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i></a>
                    <h3><a href="#">Easily Buy & Sell </a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the
                        industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                    <h3><a href="#">Quality Products</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the
                        industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a>
                    <h3><a href="#">100% Secure Payment</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the
                        industry's standaum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Area End Here -->

<!-- Author Banner Area Start Here -->
<div class="author-banner-area">
    <div class="author-banner-wrapper">
        <div id="ri-grid" class="author-banner-bg ri-grid header text-center">
            <ul class="ri-grid-list">
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
            </ul>
        </div>
        <div class="author-banner-content">
            <ul>
                <li>
                    <p>Over <span> 20,000</span> Author Are Involved Here!</p>
                </li>
                <li><a href="#" class="btn-fill-textPrimary">Become A Author</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Author Banner Area End Here -->
<?php require_once 'footer.php' ?>

<!-- Footer Area Start Here -->