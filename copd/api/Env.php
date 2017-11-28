<?php
//----------------------------------------------------------------------------------Env
//connet db
require 'connect.php';
mysqli_select_db($con,"env");
//response by method
class Env{
	function getAll(){
		//query data by method
		
		$getAll_sql = "SELECT * FROM env";
		$getAll_result = mysqli_query($con,$getAll_sql);
		$getAll_dataArray = array();

		while($row = mysqli_fetch_array($getAll_result)) {
		    $getAll_dataArray[] = array($row["deviceid"],$row["temperature"],$row["humidity"],$row["pm25"],$row["uv"],$row['datetime']);
		}
		echo json_encode($getAll_dataArray);
		//return array($getAll_dataArray);
		//return array("id"=>"ray");
	}
	
	function getById(){

		$getById_sql = "SELECT * FROM env WHERE deviceid = '$deviceid'";
		$getById_result = mysqli_query($con,$getById_sql);
		$getById_dataArray = array();

		while($row = mysqli_fetch_array($getById_result)) {
		    $getById_dataArray[] = array($row["deviceid"],$row["temperature"],$row["humidity"],$row["pm25"],$row["uv"],$row['datetime']);
		}
		echo json_encode($getById_dataArray);
		//return array($getById_dataArray);
		//return array("id"=>"ray");
	}

	function add(){
		$sql_insert = "INSERT INTO env (deviceid, temperature, humidity, pm25, uv, datetime) VALUES ('$id','$temperature','$humidity','$pm25','$uv','$datetime')";
		$result = mysqli_query($con,$sql_insert);
	}

}
?>
