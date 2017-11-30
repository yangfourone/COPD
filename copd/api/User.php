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
		mysqli_select_db($con,"user");
		
		//query data by method
		$getById_sql = "SELECT * FROM user WHERE id = '$id'";
		$getById_result = mysqli_query($con,$getById_sql);

		if(mysqli_num_rows($getById_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$getById_dataArray = mysqli_fetch_all($getById_result,MYSQLI_ASSOC);
			return $getById_dataArray;
		}
	}

	function add($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		$id = $input['id'];
		$pwd = $input['pwd'];
		$fname = $input['fname'];
		$lname = $input['lname'];
		$sex = $input['sex'];
		$bmi = $input['bmi'];
		$history = $input['history'];
		$drug = $input['drug'];
		$env_id = $input['env_id'];
		$ble_id = $input['ble_id'];
		$watch_id = $input['watch_id'];

		$sql_check = "SELECT * FROM user WHERE id = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			$sql_insert = "INSERT INTO user (id,pwd,fname,lname,sex,bmi,history,drug,env_id,ble_id,watch_id) VALUES ('$id','$pwd','$fname','$lname','$sex','$bmi','$history','$drug','$env_id','$ble_id','$watch_id')";
			$add_result = mysqli_query($con,$sql_insert);
			return 'ok';
		}
		else {
			return 'The id '.$id.' is existense.';
		}
	}

	function delete($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");

		$sql_check = "SELECT * FROM user WHERE id = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$sql_delete = "DELETE FROM user WHERE id = '$id'";
			$del_result = mysqli_query($con,$sql_delete);	
			return 'ok';
		}
	}

	function update($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"user");
		$id = $input['id'];
		$pwd = $input['pwd'];
		$fname = $input['fname'];
		$lname = $input['lname'];
		$sex = $input['sex'];
		$bmi = $input['bmi'];
		$history = $input['history'];
		$drug = $input['drug'];
		$env_id = $input['env_id'];
		$ble_id = $input['ble_id'];
		$watch_id = $input['watch_id'];

		$sql_check = "SELECT * FROM user WHERE id = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$sql_update ="UPDATE user SET pwd='$pwd', fname='$fname', lname='$lname', sex='$sex', bmi='$bmi', history='$history', drug='$drug', env_id='$env_id', ble_id='$ble_id', watch_id='$watch_id' WHERE id='$id'";
			$update_result = mysqli_query($con,$sql_update);	
			return 'ok';
		}
	}
}

?>