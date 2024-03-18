<?php require_once 'header.php' ?>
<!-- Main Banner 1 Area Start Here -->
<?php




require_once 'search.php';



?>




<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">

        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Product Page Grid Start Here -->
<div class="product-page-list bg-secondary section-space-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="page-controls">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                <div class="page-controls-sorting">
                                    <div class="dropdown">
                                        <button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">Default Sorting<i class="fa fa-sort" aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Date</a></li>
                                            <li><a href="#">Best Sale</a></li>
                                            <li><a href="#">Rating</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                <div class="layout-switcher">
                                    <ul>
                                        <li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                            <div class="product-list-view">

                                <!-- Buraya While Gelecek -->

                                <?php



                                $sayfada = 2; // sayfada kaç adet ürün olacağını belirleyen değişken



                                // kategori_ıd Geliyorsa bilgileri çekiyor 
                                // idler uyusmuyorsa hata veriyor


                                if (isset($_GET['kategori_id'])) {
                                    $sorgu = $db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id");
                                    $sorgu->execute(array(
                                        'kategori_id' => $_GET['kategori_id']
                                    ));
                                } else {
                                    $sorgu = $db->prepare("SELECT * FROM urun");
                                    $sorgu->execute();
                                }

                                // Sayfa Sayısını Ayarları

                                $toplam_icerik = $sorgu->rowCount();
                                $toplam_sayfa = ceil($toplam_icerik / $sayfada);

                                // Eğer sayfa girilmediyse veya 1'den küçük bir sayfa sayısı girildiyse 1 olarak varsayalım
                                $sayfa = isset($_GET['sayfa']) ? max(1, (int)$_GET['sayfa']) : 1;

                                // Eğer sayfa sayısı toplam sayfadan büyükse, en son sayfayı kullanalım
                                if ($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa;

                                $limit = ($sayfa - 1) * $sayfada;


                                // Sayfa Sayısını Ayarları End



                                // Tabloları Çekme

                                if (isset($_GET['kategori_id'])) {
                                    $urunsor = $db->prepare("SELECT urun.*,kategori.*,kullanici.* FROM urun 
        INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
        INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
        WHERE urun.urun_durum=:durum AND kategori.kategori_id=:katID 
        ORDER BY urun.urun_zaman DESC LIMIT $limit,$sayfada");
                                    $urunsor->execute(array(
                                        'durum' => 1,
                                        'katID' => $_GET['kategori_id']
                                    ));
                                } else {
                                    $urunsor = $db->prepare("SELECT urun.*,kategori.*,kullanici.* FROM urun 
        INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id 
        INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id 
        WHERE urun.urun_durum=:durum ORDER BY urun.urun_zaman DESC LIMIT $limit,$sayfada");
                                    $urunsor->execute(array(
                                        'durum' => 1
                                    ));
                                }

                                $say = $urunsor->rowCount();

                                if ($say == 0) {
                                    echo "bu Kategori Ürün Bulnumadı.";
                                }

                                $uruncek = $urunsor->fetchAll();







                                //   while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                                foreach ($uruncek as $butunBilgiler) {
                                ?>



                                    <div class="single-item-list">
                                        <div class="item-img">
                                            <a href="urun-<?= seo($butunBilgiler['urun_ad']) . "-" . $butunBilgiler['urun_id'] ?>"> <img style="width: 239px; height: 180px;" src=" <?php echo $butunBilgiler['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"> </a>
                                        </div>
                                        <a href="urun-<?= seo($butunBilgiler['urun_ad']) . "-" . $butunBilgiler['urun_id'] ?>">
                                            <div class="item-content">
                                                <div class="item-info">
                                                    <div class="item-title">
                                                        <h3><a href="urun-<?= seo($butunBilgiler['urun_ad']) . "-" . $butunBilgiler['urun_id'] ?>"><?php echo $butunBilgiler['urun_ad'] ?></a></h3>
                                                        <span><?php echo $butunBilgiler['kategori_ad'] ?></span>
                                                    </div>

                                                    <div class="item-sale-info">
                                                        <div class="price" style="font-size: 19px; width: 100px;"><?php echo $butunBilgiler['urun_fiyat'] ?> <span style="font-size: 15px;">₺</span></div>
                                                        <div class="sale-qty">Sales ( 11 )</div>
                                                    </div>
                                                </div>
                                                <div class="item-profile">
                                                    <div class="profile-title">
                                                        <div class="img-wrapper"><img width="38" height="38" src="<?php echo $butunBilgiler['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                                        <span><?php echo $butunBilgiler['kullanici_ad'] ?></span>
                                                    </div>
                                                    <div class="profile-rating-info">
                                                        <ul>
                                                            <li>
                                                                <ul class="profile-rating">
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                    <li>(<span> 05</span> )</li>
                                                                </ul>
                                                            </li>
                                                            <li><i class="fa fa-comment-o" aria-hidden="true"></i>( 10 )</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>



                                <?php } ?>


                                <!-- <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li> -->


                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul class="pagination-align-left">


                                            <?php

                                            $s = 0;

                                            while ($s < $toplam_sayfa) {

                                                $s++;

                                                if (!empty($_GET['kategori_id'])) {

                                                    if ($s == $sayfa) {
                                            ?>
                                                        <li class="active"><a href="kategoriler-<?php echo $_GET['sef']; ?>-<?php echo $_GET['kategori_id'] ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a href="kategoriler-<?php echo $_GET['sef']; ?>-<?php echo $_GET['kategori_id'] ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
                                                    <?php
                                                    }
                                                } else {

                                                    if ($s == $sayfa) {
                                                    ?>
                                                        <li><a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <li><a href="kategoriler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>















                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->

            <?php require_once 'sidebar.php'; ?>




            <!-- Fiyat Aralığı -->

            <!-- <div class=" sidebar-item">
                                                                <div class="sidebar-item-inner">
                                                                    <h3 class="sidebar-item-title">Price Range</h3>
                                                                    <div id="price-range-wrapper" class="price-range-wrapper">
                                                                        <div id="price-range-filter"></div>
                                                                        <div class="price-range-select">
                                                                            <div class="price-range" id="price-range-min"></div>
                                                                            <div class="price-range" id="price-range-max"></div>
                                                                        </div>
                                                                        <button class="sidebar-full-width-btn disabled" type="submit" value="Login"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                                                                    </div>
                                                                </div>
                                    </div> -->


        </div>
    </div>









</div>
</div>
</div>
<!-- Product Page Grid End Here -->
<?php require_once 'footer.php' ?>