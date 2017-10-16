<?php
// 設置資料類型 json
// 連結資料庫
require 'connect.php';
mysqli_select_db($con,"user");

if (!isset($_POST['ID']) || empty($_POST['ID']) ||
	!isset($_POST['Firstname']) || empty($_POST['Firstname']) ||
    !isset($_POST['Lastname']) || empty($_POST['Lastname']) ||
    !isset($_POST['Sex']) || 
	!isset($_POST['BMI']) || empty($_POST['BMI']) ||
	!isset($_POST['History']) || empty($_POST['History']) ||
	!isset($_POST['Drug']) || empty($_POST['Drug'])) 
	{
    	echo json_encode(array('msg' => 'The data is not complete!!'));

        return;
    }
else {
	$id = $_POST['ID'];
	$fname = $_POST['Firstname'];
	$lname = $_POST['Lastname'];
	$sex = $_POST['Sex'];
	$bmi = $_POST['BMI'];
	$history = $_POST['History'];
	$drug = $_POST['Drug'];
	$sql_insert = "INSERT INTO user (id, fname, lname, sex, bmi, history, drug) VALUES ('$id','$fname','$lname','$sex','$bmi','$history','$drug')";
	$result = mysqli_query($con,$sql_insert);	
	
	}

// 儲存成功，返回姓名
echo json_encode(array('Firstname' => $_POST['Firstname']));

?>