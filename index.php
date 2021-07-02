<?php
$ts = disk_total_space(".");
$fs = disk_free_space(".");

echo "Total Space: ".hz($ts)."<br>Available Space: ".hz($fs);


function hz($bytes, $dec = 2) {
    $size   = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}
