<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
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

                        <h2 class="title-section">Giden Mesajlar</h2>

                        <div class="personal-info inner-page-padding">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mesaj Tarih</th>
                                        <th scope="col">Gönderen Kullanıcı</th>
                                        <th scope="col">Detay</th>
                                        <th scope="col">Sil</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $mesajsor = $db->prepare("SELECT mesaj.*,kullanici.* FROM mesaj INNER JOIN kullanici ON mesaj.mesaj_gel=kullanici.kullanici_id WHERE mesaj.mesaj_gon=:id ORDER BY mesaj_okunma,mesaj_zaman DESC");

                                    $mesajsor->execute(array(
                                        'id' => $_SESSION['kullaniciID']
                                    ));

                                    $say = 1;

                                    while ($mesajcek = $mesajsor->fetch(PDO::FETCH_ASSOC)) {

                                        $kullaniciGon = $mesajcek['mesaj_gon']

                                    ?>
                                        <tr>
                                            <th><?php echo $say++ ?></th>

                                            <td><?php echo $mesajcek['mesaj_zaman'] ?></td>

                                            <td><?php echo $mesajcek['kullanici_ad'] . " " . $mesajcek['kullanici_soyad'] ?></td>

                                            <td><a href="mesaj-detay?mesajId=<?php echo $mesajcek['mesaj_id'] ?>&kullanicigon=<?php echo $kullaniciGon ?>&gidenMesaj=ok"><button class="btn btn-info">Oku</button></a></td>

                                            <td>
                                                <a onclick="return confirm('Bu Ürünü Silmek İstiyormunuz')" href="nedmin/netting/kullaniciislemleri.php?mesajID=<?php echo $mesajcek['mesaj_id'] ?>&gidenMesajSil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center>
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