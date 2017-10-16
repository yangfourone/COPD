<?php
header('Content-Type: application/json; charset=UTF-8');

//連結資料庫 (hostname,username,password,database name)
$con = mysqli_connect('localhost','root','qcg444ntn','session_login');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

?>