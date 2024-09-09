<?php
require 'dizziness.php';

$password = "text";
$dizziness_key = "random alphabet&number";
$target_blocks = 1024;
$repeats = 64;

$hashed_password = Dizziness::generate_dizziness_hash($password, $dizziness_key, $target_blocks, $repeats);

echo "Final Hash: " . $hashed_password . "\n";
?>
