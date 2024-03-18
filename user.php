<?php
require_once 'header.php';


$kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id AND kullanici_magaza=:magaza");

$kullanicisor->execute(array(
    'id' => $_GET['kullId'],
    'magaza' => 2
));

$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);




?>


<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Profile Page Start Here -->
<div class="profile-page-area bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">

            <!-- Üst banner -->
            <?php require_once 'user-header.php' ?>

            <!-- Üst banner end -->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">Satıcı</h3>
                            <div class="sidebar-author-info">
                                <div class="sidebar-author-img">
                                    <img style="width: 73px; 63px" src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                                </div>
                                <div class="sidebar-author-content">
                                    <h3><?php echo $kullanicicek['kullanici_ad'] ?></h3>
                                    <?php

                                    // Profil Online || Offline Kodları


                                    $musterikullanici_sonzaman = strtotime($kullanicicek['kullanici_sonzaman']);

                                    $suan = time();

                                    $fark = ($suan - $musterikullanici_sonzaman);

                                    if ($fark < 50) { ?>
                                        <a href="#" class="view-profile"><i class="fa fa-circle" aria-hidden="true"></i> Online</a>
                                    <?php } else { ?>
                                        <a href="#" class="view-profile"><i style="color: red;" class="fa fa-circle" aria-hidden="true"></i> Offline</a>
                                    <?php }
                                    // Profil Online END

                                    ?>







                                </div>

                            </div>

                            <ul class="sidebar-badges-item">

                                <?php

                                // Burada satıcının sattığı ürün kadar rütbe çıkarmaya yarayan kod parçası

                                $urunSay = $db->prepare("SELECT COUNT(kullanici_idsatici) AS say FROM siparis_detay WHERE kullanici_idsatici=:id");

                                $urunSay->execute(array(
                                    'id' => $_GET['kullId']
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





                            </ul>



                        </div>
                    </div>
                    <ul class="social-default">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                    <ul class="sidebar-product-btn">

                        <?php


                        if (empty($_SESSION['kullaniciID'])) {
                        ?>

                            <li><a href="login" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i>Mesaj</a></li>

                        <?php
                        } else if ($_SESSION['kullaniciID'] == $_GET['kullId']) {
                        ?>

                            <li><a href="contact.htm" class="buy-now-btn" id="buy-button"><i class="fa fa-ban" aria-hidden="true"></i>Mesaj Yollayamazsın</a></li>

                        <?php
                        } else {
                        ?>

                            <li><a href="mesaj-gonder?kullaniciGel=<?php echo $_GET['kullId'] ?>" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesaj </a></li>


                        <?php } ?>





                        <!-- <li><a href="#" class="add-to-cart-btn" id="cart-button">Following</a></li> -->
                    </ul>

                </div>
            </div>
        </div>
        <div class="row profile-wrapper">



            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <?php require_once 'user-sidebar.php' ?>
            </div>



            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="tab-content">


                    <div class="tab-pane fade active in" id="Products">
                        <h3 class="title-inner-section">Ürünleri</h3>
                        <div class="inner-page-main-body">
                            <div class="row more-product-item-wrapper">

                                <?php

                                $urunsor = $db->prepare("SELECT urun.*,kategori.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id WHERE urun.kullanici_id=:id");
                                $urunsor->execute(array(
                                    'id' => $_GET['kullId']
                                ));


                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {


                                ?>


                                    <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                        <div class="more-product-item">
                                            <div class="more-product-item-img">
                                                <img style="width: 100px; height: 90px; " src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
                                            </div>
                                            <div class="more-product-item-details">
                                                <h4><a href="urun-detay.php?urunId=<?php echo $uruncek['urun_id'] ?>"><?php echo $uruncek['urun_ad'] ?></a></h4>
                                                <div class="p-title"><?php echo $uruncek['kategori_ad'] ?></div>
                                                <div class="p-price"><?php echo $uruncek['urun_fiyat'] ?> ₺</div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>



                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="Profile">
                        <div class="inner-page-details inner-page-content-box">
                            <h3>Hakkımızda :</h3>
                            <p>Bimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.</p>
                        </div>
                    </div>





                    <div class="tab-pane fade" id="Message">
                        <h3 class="title-inner-section">Message Box</h3>
                        <div class="message-wrapper">
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\3.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose</h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\4.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose</h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                                <div class="single-item-inner-author">
                                    <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span> Author</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\6.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose</h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <ul class="pagination-profile-align-center">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                </ul>
                            </div>
                            <div class="single-item-message">
                                <h3>Leave A Comment</h3>
                                <div class="leave-comments-message">
                                    <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                    <div class="leave-comments-box">
                                        <textarea placeholder="Write your comment here ...*" class="textarea form-control" name="message"></textarea>
                                        <button type="submit" class="update-btn">Post Comment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Reviews">
                        <h3 class="title-inner-section">Customer Reviews ( 20 )</h3>
                        <div class="reviews-wrapper">
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\3.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\4.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\6.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\7.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <div class="single-item-inner">
                                    <img src="img\profile\8.jpg" alt="profile" class="img-responsive">
                                    <div class="item-content">
                                        <h4>Richi Rose<span>WordPress</span></h4>
                                        <span>2 days ago</span>
                                        <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
                                        <div class="profile-rating">
                                            <ul>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-item-message">
                                <ul class="pagination-profile-align-center">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Followers">
                        <h3 class="title-inner-section">Followers</h3>
                        <div class="inner-page-main-body">
                            <div class="row more-product-item-wrapper">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\5.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Psdart</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\6.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">RadiusTheme</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\7.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Maxbox</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\8.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Dancty</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\9.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Austonea</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\10.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Branadom</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\11.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Grand Balle</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\12.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Akkas</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img src="img\profile\13.jpg" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="#">Moinar ma</a></h4>
                                            <div class="a-item">516 Items</div>
                                            <div class="a-followers">406 Followers</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <ul class="pagination-align-left">
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Profile Page End Here -->
<?php
require_once 'footer.php';


?>