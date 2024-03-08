<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
    <div class="fox-sidebar">
        <div class="sidebar-item">
            <div class="sidebar-item-inner">
                <h3 class="sidebar-item-title">Kategoriler</h3>
                <ul class="sidebar-categories-list">
                    <?php
                    $kategorisor = $db->prepare("SELECT * FROM kategori WHERE kategori_durum=:durum order by kategori_sira ASC");
                    $kategorisor->execute(array(
                        'durum' => 1
                    ));

                    while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                        <li><a href="#"><?php echo $kategoricek['kategori_ad'] ?><span>(

                                    <?php

                                    // Hangi Katgoride Kaç Ürün var olduğunu görmek için aşağıdaki kod parçasını çalıştır


                                    // $katID = $kategoricek['kategori_id'];

                                    // $sayCek = $db->prepare("SELECT COUNT(kategori_id) AS say FROM urun WHERE kategori_id=:id");

                                    // $urunCek->execute(array(
                                    //     'id' => $katID
                                    // ));

                                    // $cek = $sayCek->fetch(PDO::FETCH_ASSOC);


                                    // echo $cek['say'];


                                    ?>


                                    )</span></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="sidebar-item">
            <div class="sidebar-item-inner">
                <h3 class="sidebar-item-title">Fiyat Aralığı</h3>
                <div id="price-range-wrapper" class="price-range-wrapper">
                    <div id="price-range-filter"></div>
                    <div class="price-range-select">
                        <div class="price-range" id="price-range-min"></div>
                        <div class="price-range" id="price-range-max"></div>
                    </div>
                    <button class="sidebar-full-width-btn disabled" type="submit" value="Login"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                </div>
            </div>
        </div>

    </div>
</div>