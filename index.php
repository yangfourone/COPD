<?php
session_start();
if(isset($_POST['Login'])){
	require 'connect.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql_query = "SELECT * FROM account WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($con,$sql_query); 
	
	$_cnt = 0;
	
	while($row = mysqli_fetch_array($result)) {
	$_cnt++;
	}
	
	if($_cnt==1){
		$_SESSION['username'] = $username;
		header('Location: datapage.php');
	}
	else 
		header('Location: LoginError.php');
	
	die();
	
}

if(isset($_POST['Register'])){
	header('Location: register.php');
}

if(isset($_GET['logout'])){
	session_unregister('username');
}


?>
<head>
<style>
.title {font-family: '標楷體'; color:#000000; font-size:36; text-align:center}
.text {font-family: '標楷體'; color:#000000; font-size:24; text-align:center}

/* Style the input */
input[type=text], [type=password] {
    width: 100%;
    padding: 5px 5px;
    margin: 2px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 5px 5px;
    margin: 2px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

/* Button Style */
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 5px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
}
.button1 {
    background-color: white;
    color: black;
    border: 2px solid #0072E3;
}

.button1:hover {backgrousnd-color: #e7e7e7;}

</style>
</head>

<br>
<br>

<body>
<h2  class=title >COPD Manage System</h2>
</body>

<br></br>
<br></br>


<form method="post">
	<table align="center" cellpadding="2" cellspacing="5" border="0">
		<tr>
			<td><text class="text">Username</text></td>
			<td><input type="text" name="username" ></td>
		</tr>
		<tr>
			<td><text class="text">Password</text></td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td><br><br></td>
		</tr>
		<tr>
			<td><button class="button button1" type="submit" name="Login" value="Login">Login</button></td>
			<td><button class="button button1" type="submit" name="Register" value="Register">Register</button></td>
		</tr>
	</table>
</form>