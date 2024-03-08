<?php
require_once 'header.php';

islemkontrol();
?>

<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.htm">Home</a><span> -</span></li>
                <li>Settings</li>
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


                <form class="form-horizontal" id="personal-info-form" action="nedmin/netting/kullaniciislemleri.php" method="post">

                    <div class="settings-details tab-content">

                        <div class="tab-pane fade active in" id="Personal">

                            <h2 class="title-section">Adres Bilgileri Düzenle</h2>

                            <div class="personal-info inner-page-padding">

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">bireysel/Kurumsal</label>
                                    <div class="col-sm-9">
                                        <div class="custom-select">
                                            <select id="kullanici_tip" name="kullTip" class='select2'>
                                                <option <?php
                                                        if ($kullanicicek['kullanici_tip'] == "PERSONAL") {
                                                            echo "selected";
                                                        }
                                                        ?> value="PERSONAL">Bireysel
                                                <option <?php
                                                        if ($kullanicicek['kullanici_tip'] == "PRIVATE_COMPANY") {
                                                            echo "selected";
                                                        }
                                                        ?> value="PRIVATE_COMPANY">Kurumsal
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div id="bireysel">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">T.C</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="kulTc" value="<?php echo $kullanicicek['kullanici_tc'] ?>" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div id="kurumsal">

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma Ünvan</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="firmaUnvan" value="<?php echo $kullanicicek['kullanici_unvan'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma V.Daire</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="firmaVDaire" value="<?php echo $kullanicicek['kullanici_vdaire'] ?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Firma V.No</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="first-name" name="firmaVno" value="<?php echo $kullanicicek['kullanici_vno'] ?>" type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">İl</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="sehir" value="<?php echo $kullanicicek['kullanici_il'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">İlçe</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" name="sehirIlce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Açık Adres</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="acikAdres" id="" cols="69" rows="3"><?php echo $kullanicicek['kullanici_adres'] ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12" align="right">
                                        <button type="submit" name="kullaniciAdresGuncelle" class="update-btn" id="login-update">Bilgileri Güncelle</button>
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