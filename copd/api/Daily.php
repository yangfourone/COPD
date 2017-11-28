<?php
//-------------------------------------------------------------------------------Daily
//connet db
require 'connect.php';
mysqli_select_db($con,"daily");
//response by method
class Daily{
	function getAll(){
		//query data by method
		$getAll_sql = "SELECT * FROM daily";
		$getAll_result = mysqli_query($con,$getAll_sql);
		$getAll_dataArray = array();

		while($row = mysqli_fetch_array($getAll_result)) {
		    $getAll_dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["date"]);
		}
		echo json_encode($getAll_dataArray);
		//return array($getAll_dataArray);
		//return array("id"=>"ray");
	}
	function getByUser(){
		//query data by method
		$getById_sql = "SELECT * FROM daily WHERE uid = '$uid'";
		$getById_result = mysqli_query($con,$getById_sql);
		$getById_dataArray = array();

		while($row = mysqli_fetch_array($getById_result)) {
		    $getById_dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["date"]);
		}
		echo json_encode($getById_dataArray);
		//return array($getById_dataArray);
		//return array("id"=>"ray");
	}
	function add(){
		$sql_insert = "INSERT INTO daily (id,uid,step,date) VALUES ('$id','$uid','$step','$date')";
		$add_result = mysqli_query($con,$sql_insert);	
	}
	function delete(){
		$sql_delete = "DELETE FROM daily WHERE id = '$id'";
		$del_result = mysqli_query($con,$sql_delete);	
	}
}

?>