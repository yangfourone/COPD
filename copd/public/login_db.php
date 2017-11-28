<?php
session_start();
require 'connect.php';
mysqli_select_db($con,"acc");
$account = $_POST['Account'];
$password = $_POST['Password'];

$sql_query = "SELECT * FROM acc WHERE account = '$account' AND password = '$password'";
$result = mysqli_query($con,$sql_query); 
	
$_cnt = 0;

if (!isset($_POST['Account']) || empty($_POST['Account']) ||
	!isset($_POST['Password']) || empty($_POST['Password'])) {
      	echo json_encode(array('msg' => '0'));
        return;
    }
else{
	while($row = mysqli_fetch_array($result)) {
		$_cnt++;
	}
	if ($_cnt==1) {
		$_SESSION['account'] = $account;
		echo json_encode(array('msg' => '1'));
	} else {
		echo json_encode(array('msg' => '0'));
	}  
}
?>