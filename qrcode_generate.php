<?php
include 'phpqrcode/qrlib.php';
$id = $_GET['id'];
$text =  "https://cms-tfpx-deetabase-44c33b50f049.herokuapp.com/qrcode_read.php?id=$id";
// $file = "./qr_code_dee_$id.png";
// $pixel_size = 5;
// $frame_size = 5; 
// QRcode::png($text, $file, $pixel_size, $frame_size);
QRcode::png($text);
// echo "<center><img src='".$file."'></center>";

?>