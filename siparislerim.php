<?php
require_once 'header.php';

islemkontrol();
?>

<!-- Inner Page Banner Area End Here -->
<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">

    <div class="container">
        <div class="row settings-wrapper">
            <?php require_once 'hesap-sidebar.php' ?>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">



                <div class="settings-details tab-content">

                    <div class="tab-pane fade active in" id="Personal">

                        <h2 class="title-section">Siparişlerim</h2>

                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sipariş Tarihi</th>
                                        <th scope="col">Sipariş Numarsı</th>
                                        <th scope="col">Sipariş Durum</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $siparissor = $db->prepare("SELECT * FROM siparis WHERE kullanici_id=:kullanici_id order by siparis_zaman DESC");
                                    $siparissor->execute(array(
                                        'kullanici_id' => $_SESSION['kullaniciID']
                                    ));
                                    $say = 1;
                                    while ($sipariscek = $siparissor->fetch(PDO::FETCH_ASSOC)) {

                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $say++ ?></th>
                                            <td><?php echo $sipariscek['siparis_zaman'] ?></td>
                                            <td><?php echo $sipariscek['siparis_id'] ?></td>
                                            <td>
                                                <center><a href="siparislerim-detay?siparisId=<?php echo $sipariscek['siparis_id'] ?>"><button class="btn btn-success btn-xs">Düzenle</button></a></center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>




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