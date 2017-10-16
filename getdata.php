<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/bootstrap-table.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/Chart.bundle.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/datatable.js"></script>
<link rel="stylesheet" href="js-datatable-1.0.4/css/bootstrap-table.css">
<link rel="stylesheet" href="js-datatable-1.0.4/css/datatable.css">

<style>
h2 {
    text-align: center;
}
</style>
</head>
<body>


<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','qcg444ntn','session_login');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if($q == 0){

}


else if($q == 1) {
mysqli_select_db($con,"user");
$sql="SELECT * FROM user";
$result = mysqli_query($con,$sql);

echo '
<table align=center 
       class="table datatable"
       data-sort-name="value1"
       data-sort-order="desc"
       data-pagination="false"
       data-show-pagination-switch="false"
>
<thead>
    <tr>
        <th data-field="value1" data-sortable=true>ID</th>
        <th data-field="value1" data-sortable=true>FirstName</th>
        <th data-field="value1" data-sortable=true>LastName</th>
        <th data-field="value1" data-sortable=true>Sex</th>
        <th data-field="value1" data-sortable=true>BMI</th>
        <th data-field="value1" data-sortable=true>History</th>
        <th data-field="value1" data-sortable=true>Drug</th>
    </tr>
</thead>';
echo "<tbody>";
while($row = mysqli_fetch_array($result)) {
    
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['fname'] . "</td>";
    echo "<td>" . $row['lname'] . "</td>";
    echo "<td>" . $row['sex'] . "</td>";
    echo "<td>" . $row['bmi'] . "</td>";
    echo "<td>" . $row['history'] . "</td>";
    echo "<td>" . $row['drug'] . "</td>";
    echo "</tr>";

}
echo "</tbody>";
echo "<p>";
echo "<h2>Patient Information</h2>";
echo "</table>";
echo "<p>";
mysqli_close($con);
}


else if($q == 2){
mysqli_select_db($con,"env");
$sql_env="SELECT * FROM env";
$result1 = mysqli_query($con,$sql_env);

echo "<table class=table table-striped table-bordered>
<thead>
<tr>
<th>id</th>
<th>temperature</th>
<th>humidity</th>
<th>pm2.5</th>
<th>uv</th>
</tr>
</thead>";
while($row1 = mysqli_fetch_array($result1)) {
    echo "<thead>";
    echo "<tr>";
    echo "<td>" . $row1['id'] . "</td>";
    echo "<td>" . $row1['temperature'] . "</td>";
    echo "<td>" . $row1['humidity'] . "</td>";
    echo "<td>" . $row1['pm2.5'] . "</td>";
    echo "<td>" . $row1['uv'] . "</td>";
    echo "</tr>";
    echo "</thead>";
}

echo "<p>";
echo "<h2>Environment Information</h2>";
echo "</table>";
echo "<p>";
mysqli_close($con);
}
?>


</body>
</html>