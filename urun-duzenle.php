<?php
require_once 'header.php';

islemkontrol();

$urunsor = $db->prepare("SELECT * FROM urun WHERE kullanici_id=:kullanici_id AND urun_id=:urun_id order by urun_zaman DESC");
$urunsor->execute(array(
    'kullanici_id' => $_SESSION['kullaniciID'],
    'urun_id' => $_GET['urunID']
));

$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);

?>


<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">

    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">


                <form class="form-horizontal" id="personal-info-form" enctype="multipart/form-data" action="nedmin/netting/adminislem.php" method="post">

                    <div class="settings-details tab-content">

                        <div class="tab-pane fade active in" id="Personal">

                            <h2 class="title-section">Ürün Düzenle</h2>

                            <div class="personal-info inner-page-padding">


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mevcut Fotoğraft</label>
                                    <div class="col-sm-9">
                                        <center> <img width="200" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt=""></center>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Resim</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name="urunfoto_resimyol" type="file">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün kategori</label>
                                    <div class="col-sm-9">




                                        <div class="custom-select">
                                            <select name="kategori_id" class='select2'>

                                                <?php
                                                $kategorisor = $db->prepare("SELECT * FROM kategori order by kategori_sira ASC");
                                                $kategorisor->execute();

                                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {

                                                ?>
                                                    <option <?php if ($kategoricek['kategori_id'] == $uruncek['kategori_id']) {
                                                                echo 'selected';
                                                            } ?> value="<?php $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad']  ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Ad</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name="urun_ad" value="<?php echo $uruncek['urun_ad'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Açıklama</label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor" id="editor1" name="urun_detay"><?php echo $uruncek['urun_detay'] ?></textarea>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1',

                                        {

                                            filebrowserBrowseUrl: 'ckfinder/ckfinder.html',

                                            filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',

                                            filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',

                                            filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                                            filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                                            filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                                            forcePasteAsPlainText: true

                                        }

                                    );
                                </script>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Fyat</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name="urun_fiyat" value="<?php echo $uruncek['urun_fiyat'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Ürün Stok</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name="urun_stok" value="<?php echo $uruncek['urun_stok'] ?>" type="text">
                                    </div>
                                </div>

                                <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                                <input type="hidden" name="eskiYol" value="<?php echo $uruncek['urunfoto_resimyol'] ?>">


                                <div class="form-group">
                                    <div class="col-sm-12" align="right">
                                        <button type="submit" name="mazagaUrunDuzenle" class="update-btn" id="login-update">Ürünü Düzele</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Settings Page End Here -->
<?php require_once 'footer.php' ?>


<script>
    $(document).ready(function() {

        $("#kullanici_tip").change(function() {

            var tip = $("#kullanici_tip").val();

            if (tip == "PERSONAL") {

                $("#kurumsal").hide();
                $("#bireysel").show();

            } else if (tip == "PRIVATE_COMPANY") {

                $("#kurumsal").show();
                $("#bireysel").hide();

            }
        }).change()
    });
</script>