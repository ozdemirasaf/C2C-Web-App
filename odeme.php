<?php
require_once 'header.php';

$urunSor = $db->prepare("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_id=:id AND urun_durum=:durum ORDER BY urun_zaman DESC");

$urunSor->execute(array(
    'id' => $_POST['urun_id'],
    'durum' => 1
));

$uruncek = $urunSor->fetch(PDO::FETCH_ASSOC);

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
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th style="width:50%">Ürün Bilgi</th>

                                    <th style="width:10%">Fiyat</th>
                                    <th style="width:22%">Satıcı</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-th="Product">

                                        <div class="row">
                                            <div class="col-sm-2 hidden-xs"><img style="width: 60px; height: 60px;" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="<?php echo $uruncek['urun_ad'] ?>" class="img-responsive" /></div>

                                            <div class="col-sm-10">

                                                <h4 class="nomargin"><?php echo $uruncek['urun_ad'] ?></h4>

                                                <p><?php echo $uruncek['urun_detay'] ?></p>

                                            </div>

                                        </div>
                                    </td>
                                    <td data-th="Price"><?php echo $uruncek['urun_fiyat'] ?> ₺</td>

                                    <?php


                                    $toplam = $uruncek['urun_fiyat'];

                                    ?>

                                    <td data-th="Quantity">
                                        <?php echo $uruncek['kullanici_ad'] ?>
                                    </td>

                                </tr>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td><button onclick="geridon()" class="btn btn-warning"><i class="fa fa-angle-left"></i> Geri dön</button></td>
                                    <td colspan="2" class="hidden-xs"></td>
                                    <td class="hidden-xs text-center"><strong>Toplam <?php echo $toplam ?> ₺</strong></td>

                                    <form action="nedmin/netting/kullaniciislemleri.php" method="post">

                                        <input type="hidden" name="kullanici_satici" value="<?php echo $uruncek['kullanici_id'] ?>">
                                        <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                                        <input type="hidden" name="urun_fiyat" value=" <?php echo $uruncek['urun_fiyat'] ?>">

                                        <td><button type="submit" name="siparisOnayIslemleri" class="btn btn-success btn-block">Siparişi Tamamla <i class="fa fa-angle-right"></i></button></td>

                                    </form>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Product Details Page End Here -->
<?php require_once 'footer.php' ?>


<script>
    function geridon() {
        window.history.back();

    }
</script>