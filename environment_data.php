<?php
session_start();
$con = mysqli_connect('localhost','root','qcg444ntn','session_login');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"env");
$sql_env="SELECT * FROM env";
$result1 = mysqli_query($con,$sql_env);
?>

<html>
<body>

<style>
/* Style the input */
input[type=text], select {
    width: 60%;
    padding: 5px 5px;
    margin: 2px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.text {
    color:#ffff00; 
    font-size:17px; 
    text-align:right;
    padding: 14px 16px;
    display: block;
}

.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
.button1 {
    background-color: #3c3c3c;
    /*border: 2px solid white;*/
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.button1:hover {
    background-color: #ddd;
    color: black;
}

.button2{
    border: none;
    padding: 5px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    background-color: white;
    color: black;
    border: 2px solid #0072E3;
}

.button2:hover {
    backgrousnd-color: #e7e7e7;
}


.addtable
{
    margin-left: auto;
    margin-right: auto;
    border: 2px solid ;
    width: 20%;
    border-color: #0072E3;
    padding: 5px 5px 5px 5px;
    text-align: right;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $("button").click(function(){
        $("p").toggle();
    });

    $("#save").click(function() {
        $.ajax({
            type: "POST",
            url: "addenvdata_db.php",
            dataType: "json",
            data: {
                ID: $("#id").val(),
                Temperature: $("#temperature").val(),
                Humidity: $("#humidity").val(),
                PM25: $("#pm25").val(),
                UV: $("#uv").val()                  
            },
            success: function(data) {
                if (data.ID) {
                    $("#Result").html('Env：' + data.ID + ' is saved successfully!');
                } else {
                    $("#Result").html(data.msg);
                }                   
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        
    })
    
    $("#delete").click(function() {
        $.ajax({
            type: "POST",
            url: "deleteenvdata_db.php",
            dataType: "json",
            data: {
                ID: $("#id").val()                  
            },
            success: function(data) {
                if (data.ID) {
                    $("#Result").html('Patient：' + data.ID + ' is deleted successfully！');
                } else {
                    $("#Result").html(data.msg);
                }                   
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        
    })
    
});
</script>



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

<div class="topnav">
    <a href="Download_Environment_Excel.php">Excel 下載</a>
    <a href="Download_Environment_PDF.php">PDF 下載</a> 
    <button class="button button1">欄位顯示或隱藏</button>
</div>

<p class="addtable" style="display:none">
        <label for="id">User's ID：</label>
        <input type="text" id="id"><br>

        <label for="temperature">Temperature：</label>
        <input type="text" id="temperature"><br>

        <label for="humidity">Humidity：</label>
        <input type="text" id="humidity"><br>

        <label for="pm25">PM 2.5：</label>
        <input type="text" id="pm25"><br>

        <label for="uv">UV：</label>
        <input type="text" id="uv"><br>

        <button  class="button2" id="save">Save</button>
        <button  class="button2" id="delete">Delete</button>
        <p id="Result"></p>
</p>


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
            <th data-field="code" data-sortable="true">id</th>
            <th data-field="value1" data-sortable="true">temperature</th>
            <th data-field="value2" data-sortable="true">humidity</th>
            <th data-field="value3" data-sortable="true">pm2.5</th>
            <th data-field="value4" data-sortable="true">uv</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        while($row1 = mysqli_fetch_array($result1)) { 
            echo '
            <tr>
                <td>'.$row1['id'].'</td>
                <td>'.$row1['temperature'].'</td>
                <td>'.$row1['humidity'].'</td>
                <td>'.$row1['pm25'].'</td>
                <td>'.$row1['uv'].'</td>
            </tr>
            ';
        }
        ?>
        
    </tbody>
</table>

</body>
</html>

