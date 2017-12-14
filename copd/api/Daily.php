<?php
//-------------------------------------------------------------------------------Daily
class Daily{
	function getAll(){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"daily");

		//query data by method
		$getAll_sql = "SELECT * FROM daily";
		$getAll_result = mysqli_query($con,$getAll_sql);
		
		if(mysqli_num_rows($getAll_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$getAll_dataArray = mysqli_fetch_all($getAll_result,MYSQLI_ASSOC);
			return $getAll_dataArray;
		}
	}
	
	function getByUser($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"daily");

		//query data by method
		$getById_sql = "SELECT * FROM daily WHERE uid = '$id'";
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
		mysqli_select_db($con,"daily");

		//query data by method
		$uid = $input['uid'];
		$step = $input['step'];
		$date = $input['date']; 

		if(!isset($uid)||empty($uid)||!isset($step)||empty($step)||!isset($date)||empty($date)){
			return 'NULL Data Exist.';
		}
		else {
			$sql_insert = "INSERT INTO daily (uid, step, date) VALUES ('$uid','$step','$date')";
			$add_result = mysqli_query($con,$sql_insert);
			return 'ok';
		}
	}
	function deletebyid($id){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"daily");

		//query data by method
		$sql_check = "SELECT * FROM daily WHERE id = '$id'";
		$check_result = mysqli_query($con,$sql_check);
		if(mysqli_num_rows($check_result) == 0) {
			return 'No data avaliable.';
		}
		else {
			$sql_delete = "DELETE FROM daily WHERE id = '$id'";
			$del_result = mysqli_query($con,$sql_delete);	
			return 'ok';
		}
	}
}

?>