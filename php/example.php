<?php
require 'dizziness.php';

$password = "password";
$dizziness_key = "password";
$target_blocks = 256;
$repeats = 32;

$hashed_password = Dizziness::generate_dizziness_hash($password, $dizziness_key, $target_blocks, $repeats);
$verfiy_hasehd_password = Dizziness::verify_dizziness_hash("password","32#password#3aa3eec6483a439fbc5be1617c1bdd400b4662c981d1e8edb236627a1fecb77b#256");//(사용자 입력값, 이미 해시된 값)

echo "Final Hash: " . $hashed_password . "\n";
if($verfiy_hasehd_password){ //true false 반환
    echo 'Success!';
}
?>