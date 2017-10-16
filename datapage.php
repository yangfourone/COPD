<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/bootstrap-table.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/Chart.bundle.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/datatable.js"></script>
<link rel="stylesheet" href="js-datatable-1.0.4/css/bootstrap-table.css">
<link rel="stylesheet" href="js-datatable-1.0.4/css/datatable.css">


<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getdata.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>

<style>
.text {
    color:#ffff00; 
    font-size:17px; 
    text-align:right;
    padding: 14px 16px;
    display: block;
}

* {
    box-sizing: border-box;
}

/* Style the header */
.header {
    background-color: #3c3c3c;
    padding: 20px;
    text-align: left;
    font-size: 28px;
    color: #ffffff;
}

/* Style the top navigation bar */
.topnav {
    overflow: hidden;
    background-color: #3c3c3c;
}

/* Style the topnav links */
.topnav a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
    background-color: #ddd;
    color: black;
}

/* Create three unequal columns that floats next to each other */
.column {
    float: left;
    padding: 10px;
}

/* Left and right column */
.column.side {
    width: 15%;
    height: 100%;
}

/* Middle column */
.column.middle {
    width: 85%;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media (max-width: 600px) {
    .column.side, .column.middle {
        width: 100%;
    }
}

/* Style the footer */
.footer {
    background-color: #3c3c3c;
    padding: 10px;
    font-size: 20px;
    color:#ffffff;
    text-align: center;
}


.left_button {
    border: none;
    color: #3c3c3c;
    padding: 5px 5px;
    text-align: left;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
}

.button1 {
    color: #0000E3;
    width: 100%;
}

.button2 {
    border: 2px solid #0072E3;
}

</style>

<body>
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

<div class="row">
        <div class="container">
            <div id="txtHint"></div>
        </div>
</div>

</body>
</html>

