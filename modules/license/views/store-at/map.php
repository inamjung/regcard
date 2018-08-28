<?php

use dosamigos\google\maps\Map;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\overlays\InfoWindow;
use yii\data\ArrayDataProvider;
use yii\helpers\Url;

$datas = $dataProvider->getModels();

$coord = new LatLng(['lat' => 19.9054293, 'lng' => 99.8346724]);
$map = new Map([
    'center' => $coord,
    'zoom' => 6,
    'width' => '100%',
    'height' => '600',
        ]);
$i = 0;
foreach ($latitude as $C) {
    $coords = new LatLng(['lat' => $latitude[$i], 'lng' => $longitude[$i]]);
    $marker = new Marker(['position' => $coords]);
    $marker->attachInfoWindow(
            new InfoWindow([
        'content' => '<h4><i class="glyphicon glyphicon-home"></i>' . $store_name[$i] . '<br>'.$name[$i]. '</h4>'.'<br>'.$store_addr[$i]
            ]));
    $map->addOverlay($marker);
    $i++;
}
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-pushpin"></i> การแสดงแผนที่ Google Map จากฐานข้อมูล</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $map->display();
        ?>
    </div>
</div>

<script type="text/javascript"
        src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyBSsKUzYG_Wz7u2qL6unHqfBOmvaZ0H1Mg&callback=initMap">
</script>