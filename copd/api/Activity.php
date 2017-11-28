<?php
//-----------------------------------------------------------------------------Activity
//connet db
require 'connect.php';
mysqli_select_db($con,"activity");
//response by method
class User{
	function getAll(){
		//query data by method
		$getAll_sql = "SELECT * FROM activity";
		$getAll_result = mysqli_query($con,$getAll_sql);
		$getAll_dataArray = array();

		while($row = mysqli_fetch_array($getAll_result)) {
		    $getAll_dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["bp"],$row["data"],$row["start_time"],$row['end_time']);
		}
		echo json_encode($getAll_dataArray);
		//return array($getAll_dataArray);
		//return array("id"=>"ray");
	}
	function getById(){
		//query data by method
		$getById_sql = "SELECT * FROM activity WHERE id = '$id'";
		$getById_result = mysqli_query($con,$getById_sql);
		$getById_dataArray = array();

		while($row = mysqli_fetch_array($getById_result)) {
		    $getById_dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["bp"],$row["data"],$row["start_time"],$row['end_time']);
		}
		echo json_encode($getById_dataArray);
		//return array($getById_dataArray);
		//return array("id"=>"ray");
	}
	function getByUser(){
		//query data by method
		$getByUserId_sql = "SELECT * FROM activity WHERE uid = '$uid'";
		$getByUserId_result = mysqli_query($con,$getByUserId_sql);
		$getByUserId_dataArray = array();

		while($row = mysqli_fetch_array($getByUserId_result)) {
		    $getByUserId_dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["bp"],$row["data"],$row["start_time"],$row['end_time']);
		}
		echo json_encode($getByUserId_dataArray);
		//return array($getByUserId_dataArray);
		//return array("id"=>"ray");
	}
	function add(){
		$sql_insert = "INSERT INTO activity (uid,step,bp,data,start_time,end_time) VALUES ('$uid','$step','$bp','$data',$start_time','$end_time')";
		$add_result = mysqli_query($con,$sql_insert);	
	}
	function delete(){
		$sql_delete = "DELETE FROM activity WHERE id = '$id'";
		$del_result = mysqli_query($con,$sql_delete);	
	}
	function update(){
		$sql_update = "UPDATE activity SET id='$id', uid='$uid', step='$step', bp='$bp', data='$data', start_time='$start_time', end_time='$end_time' WHERE id='$id'";
		$update_result = mysqli_query($con,$sql_update);	
	}

}
?>