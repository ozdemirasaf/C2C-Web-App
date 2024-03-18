<?php
require_once 'header.php';

islemkontrol();




$kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");

$kullanicisor->execute(array(
    'id' => $_GET['kullaniciGel']
));

$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);



?>

<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>

            </ul>
        </div>
    </div>
</div>
<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">

    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">


                <form class="form-horizontal" id="personal-info-form" enctype="multipart/form-data" action="nedmin/netting/kullaniciislemleri.php" method="post">

                    <div class="settings-details tab-content">

                        <div class="tab-pane fade active in" id="Personal">

                            <h2 class="title-section">Mesaj Gönderme</h2>

                            <div class="personal-info inner-page-padding">


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Gönderilen Satıcı Adı</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="first-name" name="mesaj_gel" disabled value="<?php echo $kullanicicek['kullanici_ad'] ?>" type="text">
                                    </div>
                                </div>

                                <input type="hidden" name="mesaj_gel" value="<?php echo $_GET['kullaniciGel'] ?>">


                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Mesaj İçerik </label>
                                    <div class="col-sm-9">
                                        <textarea class="ckeditor" id="editor1" name="mesaj_detay"></textarea>
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
                                    <div class="col-sm-12" align="right">
                                        <button type="submit" name="mesajgelislemleri" class="update-btn" id="login-update">Mesaj Gönder</button>
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