<?php
require 'dizziness.php';

$password = "jeonwoohyuni213123";
$dizziness_key = "12n9d1n9d12ij09jd9iahds9ihasdkj";
$target_blocks = 1024;
$repeats = 64;

$hashed_password = Dizziness::generate_dizziness_hash($password, $dizziness_key, $target_blocks, $repeats);

echo "Final Hash: " . $hashed_password . "\n";
?>
