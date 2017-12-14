<?php
require 'connect.php';
$time_select = $_POST['Time'];

if($time_select==1){
	//this week
	$starttime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	$endtime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d')-7, date('Y'))) ;
	mysqli_select_db($con,"activity");
	$sql = "SELECT * FROM activity WHERE start_time BETWEEN '$endtime' AND '$starttime'";
	$result = mysqli_query($con,$sql);

	$dataArray = array();

	while($row = mysqli_fetch_array($result)) {
	    $dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["start_time"],$row["end_time"]);
	}
	echo json_encode($dataArray);
}
else if($time_select==2){
	//this month
	$starttime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;
	$endtime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m')-1, date('d'), date('Y'))) ;
	mysqli_select_db($con,"activity");
	$sql = "SELECT * FROM activity WHERE start_time BETWEEN '$endtime' AND '$starttime'";
	$result = mysqli_query($con,$sql);

	$dataArray = array();

	while($row = mysqli_fetch_array($result)) {
	    $dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["start_time"],$row["end_time"]);
	}
	echo json_encode($dataArray);
}
else {
	mysqli_select_db($con,"activity");
	$sql = "SELECT * FROM activity";
	$result = mysqli_query($con,$sql);

	$dataArray = array();

	while($row = mysqli_fetch_array($result)) {
	    $dataArray[] = array($row["id"],$row["uid"],$row["step"],$row["start_time"],$row["end_time"]);
	}
	echo json_encode($dataArray);
}

?>