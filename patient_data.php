<?php
session_start();
$con = mysqli_connect('localhost','root','qcg444ntn','session_login');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"user");
$sql="SELECT * FROM user";
$result = mysqli_query($con,$sql);
?>

<html>
<body>

<style>
.text {
    color:#ffff00; 
    font-size:17px; 
    text-align:right;
    padding: 14px 16px;
    display: block;
}
</style>


<div class="header">
<header>COPD Manage System</header>
</div>

<div class="topnav">
    <a href="datapage.php">首頁</a>
    <a href="patient_data.php">病患資料</a>
    <a href="environment_data.php">環境資料</a>
    <a id="exercise_data">運動資料</a>
    <a href="index.php?action=logout">登出</a>
    <text class="text">Hi! <?php echo $_SESSION['username'] ?> &nbsp;</text>
</div>

<br></br>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/bootstrap-table.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/Chart.bundle.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/datatable.js"></script>
<link rel="stylesheet" href="js-datatable-1.0.4/css/bootstrap-table.css">
<link rel="stylesheet" href="js-datatable-1.0.4/css/datatable.css">
<link rel="stylesheet" href="title.css">

<table class="table datatable"
       data-id-field="code"
       data-sort-name="value1"
       data-sort-order="desc"
       data-pagination="false"
       data-show-pagination-switch="false">
    <thead>
        <tr>
            <th data-field="code" data-sortable="true">ID</th>
            <th data-field="value1" data-sortable="true">FirstName</th>
            <th data-field="value2" data-sortable="true">LastName</th>
            <th data-field="value3" data-sortable="true">Sex</th>
            <th data-field="value4" data-sortable="true">BMI</th>
            <th data-field="value5" data-sortable="true">History</th>
            <th data-field="value6" data-sortable="true">Drug</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row = mysqli_fetch_array($result)) { 
            echo '
            <tr>
                <td>'.$row['id'].'</td>
                <td>'.$row['fname'].'</td>
                <td>'.$row['lname'].'</td>
                <td>'.$row['sex'].'</td>
                <td>'.$row['bmi'].'</td>
                <td>'.$row['history'].'</td>
                <td>'.$row['drug'].'</td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>

</body>
</html>

