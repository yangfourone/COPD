<?php
session_start();
//-----------------------------------------------------------------------------Admin
//response by method
class Admin{
	function login($input){
		//connet db
		require 'connect.php';
		mysqli_select_db($con,"admin");

		$account = $input['account'];
		$pwd = $input['pwd'];

		if(!isset($account)||empty($account)||!isset($pwd)||empty($pwd)) {
			return 'account or password is empty';
		}
		else {
			//query data by method
			$login_sql = "SELECT * FROM admin WHERE account = '$account' AND pwd = '$pwd'";
			$login_result = mysqli_query($con,$login_sql);

			if(mysqli_num_rows($login_result) == 0) {
				return 'error account or password';
			}
			else {
				//-------------------------------------base64encode
				function base64url_encode($data) { 
			  		return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
				} 
				function base64url_decode($data) { 
				  	return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
				} 
				//----------------------------------------JWT
				$header = [
					"alg" => "HS256",
					"typ" => "JWT"
				];
				$header = base64url_encode(json_encode($header));

				$payload = [
					"account" => $account,
				  	"password" => $pwd,
				  	"iat" => $_SERVER['REQUEST_TIME'],
				  	"exp" => $_SERVER['REQUEST_TIME'] + 1800
				];
				$payload = base64url_encode(json_encode($payload));

				$key = 'secret';
				$signature = base64url_encode(hash_hmac('sha256', $header.'.'.$payload, $key, true));

				$token = $header.'.'.$payload.'.'.$signature;
				//echo '<script>console.log('.$token.');</script>';
				//-------------------------------------------
				//$_SERVER['HTTP_AUTHORIZATION'] = $token;
				$_SESSION['account'] = $account;
				return 'login success';
			}
		}
	}
}

?>