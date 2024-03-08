<?php require_once 'header.php' ?>
<!-- Main Banner 1 Area Start Here -->
<?php
require_once 'search.php';

if (isset($_GET['kategori_id'])) {

    $sayfada = 6;  // sayfa sayısını gösterme

    $sorgu = $db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id");

    $sorgu->execute(array(
        'kategori_id' => $_GET['kategori_id']
    ));

    $toplamIcerik = $sorgu->rowCount();


    $toplamSayfa = ceil($toplamIcerik / $sayfada);

    // Eğer sayfa girilmemişse 1 varsayalım.

    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

    // Eğer 1'den Küçük bir sayfa sayısı girildiyse  1 yapalım.


    if ($sayfa < 1) $sayfa = 1;

    // Toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayılım.

    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;

    $limit = ($sayfa - 1) * $sayfada;



    // Tüm tablo sutunlarini cekilmesi

    $urunsor = $db->prepare("SELECT urun.*, kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum AND kategori_id=:kategori_id");

    $urunsor->execute(array(
        'urun_durum' => 1,
        'kategori_id' => $_GET['kategori_id']
    ));

    $say = $sorgu->rowCount();
} else {

    $sayfada = 6;  // sayfa sayısını gösterme

    $sorgu = $db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id");

    $sorgu->execute(array(
        'kategori_id' => $_GET['kategori_id']
    ));

    $toplamIcerik = $sorgu->rowCount();


    $toplamSayfa = ceil($toplamIcerik / $sayfada);

    // Eğer sayfa girilmemişse 1 varsayalım.

    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

    // Eğer 1'den Küçük bir sayfa sayısı girildiyse  1 yapalım.


    if ($sayfa < 1) $sayfa = 1;

    // Toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayılım.

    if ($sayfa > $toplamSayfa) $sayfa = $toplamSayfa;

    $limit = ($sayfa - 1) * $sayfada;



    // Tüm tablo sutunlarini cekilmesi

    $urunsor = $db->prepare("SELECT urun.*, kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum AND kategori.kategori_id=:kategori_id ORDER BY urun_zaman DESC LIMIT $limit,$sayfada");

    $urunsor->execute(array(
        'urun_durum' => 1,
        'kategori_id' => $_GET['kategori_id']
    ));

    $say = $sorgu->rowCount();
}

$urunSor = $db->prepare("SELECT * FROM urun");

$urunSor->execute();


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
                                while ($uruncek = $urunSor->fetch(PDO::FETCH_ASSOC)) {
                                ?>

                                    <a href="urun-detay.php?urunId=<?php echo $uruncek['urun_id'] ?>">

                                        <div class="single-item-list">
                                            <div class="item-img">
                                                <img style="width: 239px; height: 180px;" src=" <?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
                                            </div>
                                            <a href="urun-detay.php?urunId=<?php echo $uruncek['urun_id'] ?>">
                                                <div class="item-content">
                                                    <div class="item-info">
                                                        <div class="item-title">
                                                            <h3><a href="#"><?php echo $uruncek['urun_ad'] ?></a></h3>
                                                            <span><?php echo $uruncek['kategori_ad'] ?></span>
                                                        </div>

                                                        <div class="item-sale-info">
                                                            <div class="price" style="font-size: 19px; width: 100px;"><?php echo $uruncek['urun_fiyat'] ?> <span style="font-size: 15px;">₺</span></div>
                                                            <div class="sale-qty">Sales ( 11 )</div>
                                                        </div>
                                                    </div>
                                                    <div class="item-profile">
                                                        <div class="profile-title">
                                                            <div class="img-wrapper"><img width="38" height="38" src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                                            <span><?php echo $kullanicicek['kullanici_ad'] ?></span>
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
                                    </a>

                                <?php } ?>


                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul class="pagination-align-left">
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require_once 'sidebar.php' ?>
        </div>
    </div>
</div>
<!-- Product Page Grid End Here -->
<?php require_once 'footer.php' ?>