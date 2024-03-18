<!-- Sidebar -->


<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
    <div class="fox-sidebar">
        <div class="sidebar-item">
            <div class="sidebar-item-inner">
                <h3 class="sidebar-item-title">Kategoriler</h3>
                <ul class="sidebar-categories-list">

                    <?php

                    // Kategori isimlerini cagirma

                    $kategoriSor = $db->prepare("SELECT * FROM kategori WHERE kategori_durum=:durum ORDER BY kategori_sira ASC");

                    $kategoriSor->execute(array(
                        'durum' => 1
                    ));

                    while ($kategoriCek = $kategoriSor->fetch(PDO::FETCH_ASSOC)) {





                    ?>
                        <li><a href="kategoriler-<?= seo($kategoriCek['kategori_ad']) . "-" . $kategoriCek['kategori_id']  ?>"><?php echo $kategoriCek['kategori_ad']  ?><span>(

                                    <?php

                                    // Kategorilerin icersinde kac adet urun oldugunu gosterme

                                    $katID = $kategoriCek['kategori_id'];

                                    $urunSay = $db->prepare("SELECT COUNT(kategori_id) AS say FROM urun WHERE kategori_id=:id");

                                    $urunSay->execute(array(
                                        'id' => $katID
                                    ));


                                    $saycek = $urunSay->fetch(PDO::FETCH_ASSOC);

                                    echo $saycek['say'];



                                    ?>



                                    )</span></a></li>
                    <?php } ?>


                </ul>
            </div>
        </div>