<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">


    <div class="inner-page-main-body">
        <div class="single-banner">
            <img src="img\banner\1.jpg" alt="product" class="img-responsive">
        </div>
        <div class="author-summery">
            <div class="single-item">
                <div class="item-title">Şehir: </div>
                <div class="item-details"><?php echo $kullanicicek['kullanici_ilce'] . " / " . $kullanicicek['kullanici_il']  ?></div>
            </div>
            <div class="single-item">
                <div class="item-title">Kayıt Zamanı: </div>
                <div class="item-details"><?php echo $kullanicicek['kullanici_zaman'] ?></div>
            </div>
            <div class="single-item">
                <div class="item-title">Puanı: </div>
                <div class="item-details">

                    <?php


                    $puansay = $db->prepare("SELECT COUNT(yorumlar.kullanici_id) AS say, SUM(yorumlar.yorum_puan) AS topla, yorumlar.*,urun.* FROM yorumlar INNER JOIN urun ON yorumlar.urun_id=urun.urun_id 
                WHERE urun.kullanici_id=:id");

                    $puansay->execute(array(
                        'id' =>  $_GET['kullId']
                    ));


                    $puancek = $puansay->fetch(PDO::FETCH_ASSOC);



                    $puan = round($puancek['topla'] / $puancek['say']);




                    ?>

                    <ul style="float: right;" class="default-rating">

                        <?php
                        // Puan ayarları

                        switch ($puan) {
                            case '5':
                        ?>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> <?php echo $puan ?></span> )</li>

                            <?php
                                break;

                            case '4':
                            ?>

                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> <?php echo $puan ?></span> )</li>

                            <?php
                                break;

                            case '3':
                            ?>

                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> <?php echo $puan ?></span> )</li>
                            <?php
                                break;
                            case '2':
                            ?>

                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> <?php echo $puan ?></span> )</li>
                            <?php
                                break;
                            case '1':
                            ?>

                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i style="color: grey;" class="fa fa-star" aria-hidden="true"></i></li>
                                <li>(<span> <?php echo $puan ?></span> )</li>
                        <?php
                        }
                        ?>
                    </ul>




                </div>
            </div>
            <div class="single-item">
                <div class="item-title">Satılan:</div>
                <div class="item-name">

                    <?php

                    // Satıcının toplam sattığı ürünleri gösterten kod parçası

                    $urunSay = $db->prepare("SELECT COUNT(kullanici_idsatici) AS say FROM siparis_detay WHERE kullanici_idsatici=:id");

                    $urunSay->execute(array(
                        'id' =>  $_GET['kullId']
                    ));


                    $saycek = $urunSay->fetch(PDO::FETCH_ASSOC);

                    echo $saycek['say'];

                    // Bitti


                    ?>



                </div>
            </div>
        </div>
    </div>
</div>