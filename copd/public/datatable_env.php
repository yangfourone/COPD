<?php
require 'connect.php';
mysqli_select_db($con,"env");
$sql = "SELECT * FROM env";
$result = mysqli_query($con,$sql);

$dataArray = array();

while($row = mysqli_fetch_array($result)) {
    $dataArray[] = array($row["id"],$row["temperature"],$row["humidity"],$row["pm25"],$row["uv"]);
}
echo json_encode($dataArray);
?>