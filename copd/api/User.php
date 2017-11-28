<?php
//-----------------------------------------------------------------------------User
//response by method
class User{
	function getAll(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		//query data by method
		$getAll_sql = "SELECT * FROM user";
		$getAll_result = mysqli_query($con,$getAll_sql);
		$getAll_dataArray = mysqli_fetch_all($getAll_result,MYSQLI_ASSOC);
		
		return $getAll_dataArray;
		/*
		while($row = mysqli_fetch_array($getAll_result)) {
		    $getAll_dataArray[] = array($row["id"],$row["pwd"],$row["fname"],$row["lname"],$row["sex"],$row["bmi"],$row['history'],$row['drug'],$row["env_id"],$row["ble_id"],$row["watch_id"]);
		}
		echo json_encode($getAll_dataArray);
		*/
		//return array($getAll_dataArray);
		//return array("id"=>"ray");
	}
	function getById($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		//query data by method
		$getById_sql = "SELECT * FROM user WHERE id = '$id'";
		$getById_result = mysqli_query($con,$getById_sql);
		$getById_dataArray = mysqli_fetch_all($getById_result,MYSQLI_ASSOC);
		
		return $getById_dataArray;
		/*
		while($row = mysqli_fetch_array($getById_result)) {
		    $getById_dataArray[] = array($row["id"],$row["pwd"],$row["fname"],$row["lname"],$row["sex"],$row["bmi"],$row['history'],$row['drug'],$row["env_id"],$row["ble_id"],$row["watch_id"]);
		}
		echo json_encode($getById_dataArray);
		*/
		//return array($getById_dataArray);
		//return array("id"=>"ray");
	}
	function add($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		$sql_insert = "INSERT INTO user (id,pwd,fname,lname,sex,bmi,history,drug,env_id,ble_id,watch_id) VALUES ('$id','$pwd','$fname','$lname','$sex','$bmi','$history','$drug','$env_id','$ble_id','$watch_id')";
		$add_result = mysqli_query($con,$sql_insert);	
	}
	function delete($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		$sql_delete = "DELETE FROM user WHERE id = '$id'";
		$del_result = mysqli_query($con,$sql_delete);	
	}
	function update($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		$sql_update ="UPDATE user SET pwd='$pwd', fname='$fname', lname='$lname', sex='$sex', bmi='$bmi', history='$history', drug='$drug', env_id='$env_id', ble_id='$ble_id', watch_id='$watch_id' WHERE id='$id'";
		$update_result = mysqli_query($con,$sql_update);	
	}

}
?>