<?php

//連結資料庫 (hostname,username,password,database name)
$con = mysqli_connect('copd.local.website','root','','COPD');
mysqli_query($con,"SET NAMES 'UTF8'");

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

?>