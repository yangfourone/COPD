<?php
//-----------------------------------------------------------------------------Activity
//response by method
class Activity{
	function getAll(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"activity");

		//query data by method
		$getAll_sql = "SELECT * FROM activity";
		$getAll_result = mysqli_query($con,$getAll_sql);
		
		if(mysqli_num_rows($getAll_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$getAll_dataArray = mysqli_fetch_all($getAll_result,MYSQLI_ASSOC);
			return $getAll_dataArray;
		}
	}

	function getById($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"activity");
		
		//query data by method
		$getById_sql = "SELECT * FROM activity WHERE id = '$id'";
		$getById_result = mysqli_query($con,$getById_sql);
		
		if(mysqli_num_rows($getById_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$getById_dataArray = mysqli_fetch_all($getById_result,MYSQLI_ASSOC);
			return $getById_dataArray;
		}
	}

	function getByUser($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"activity");
		
		//query data by method
		$getByUserId_sql = "SELECT * FROM activity WHERE uid = '$id'";
		$getByUserId_result = mysqli_query($con,$getByUserId_sql);
		
		if(mysqli_num_rows($getByUserId_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$getByUserId_dataArray = mysqli_fetch_all($getByUserId_result,MYSQLI_ASSOC);
			return $getByUserId_dataArray;
		}
	}

	function add($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"activity");

		$uid = $input['uid'];
		$step = $input['step'];
		$bp = json_encode($input['bp']);
		$data = json_encode($input['data']);
		$start_time = $input['start_time'];
		$end_time = $input['end_time'];
		
		$sql_insert = "INSERT INTO activity (uid,step,bp,data,start_time,end_time) VALUES ('$uid','$step','$bp','$data','$start_time','$end_time')";
		$add_result = mysqli_query($con,$sql_insert);
		return 'ok';
	}

	function delete($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"activity");
		
		//query data by method
		$sql_check = "SELECT * FROM activity WHERE id = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$sql_delete = "DELETE FROM activity WHERE id = '$id'";
			$del_result = mysqli_query($con,$sql_delete);	
			return 'ok';
		}
	}

	function updatebyid($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"activity");
		
		$id = $input['id'];
		$step = $input['step'];
		$bp = json_encode($input['bp']);
		$data = json_encode($input['data']);
		$start_time = $input['start_time'];
		$end_time = $input['end_time'];

		$sql_check = "SELECT * FROM activity WHERE id = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$sql_update ="UPDATE activity SET step='$step', bp='$bp', data='$data', start_time='$start_time', end_time='$end_time' WHERE id='$id'";
			$update_result = mysqli_query($con,$sql_update);	
			return 'ok';
		}
	}
}

?>