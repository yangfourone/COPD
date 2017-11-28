<?php
require 'connect.php';
mysqli_select_db($con,"user");
$sql = "SELECT * FROM user";
$result = mysqli_query($con,$sql);

$dataArray = array();

while($row = mysqli_fetch_array($result)) {
    $dataArray[] = array($row["id"],$row["fname"],$row["lname"],$row["sex"],$row["bmi"],$row['history'],$row['drug']);
}
echo json_encode($dataArray);
?>