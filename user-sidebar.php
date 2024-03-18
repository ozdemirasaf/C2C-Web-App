<ul class="profile-title">

    <li class="active"><a href="#Products" data-toggle="tab" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i> Ürünler (


            <?php




            $sayCekSorgu = $db->prepare("SELECT COUNT(kategori_id) AS say FROM urun WHERE kullanici_id=:id");
            $sayCekSorgu->execute(array(
                'id' => $kullanicicek['kullanici_id']
            ));

            $sayCekSonucu = $sayCekSorgu->fetch(PDO::FETCH_ASSOC);

            echo $sayCekSonucu['say'];


            ?>


            )</a></li>


    <li class=""><a href="#Profile" data-toggle="tab" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> Hakkımızda</a></li>


    <li><a href="#Message" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Yorumlar</a></li>

</ul>