<?php
$gpx = simplexml_load_file("test2.gpx");
foreach ($gpx->wpt as $pt) {
    $lat = (string) $pt['lat'];
    echo $lat;
    $lon = (string) $pt['lon'];
    $ele = (string) $pt->ele;
    $name = (string) $pt->name;
}
unset($gpx);
?>