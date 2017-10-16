<!DOCTYPE html>
<html>

<style>

* {
    box-sizing: border-box;
}

/* Table Style */
table {
    width: 80%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}


/* Style the input */
input[type=text], [type=password] {
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
    width: 20%;
}

/* Middle column */
.column.middle {
    width: 80%;
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

<body>

<div class="header">
<header>COPD Manage System</header>
</div>

<div class="topnav">
    <a href="index.php">首頁</a>
</div>

<div class="row">   
    <div class="column side">
        <h1 class="look">Nurse Manage</h1>
        <div>
            <label for="id">Nurse ID：</label>
            <input type="text" id="id"><br>

            <label for="username">Nickname：</label>
            <input type="text" id="username"><br>

            <label for="fullname">Fullname：</label>
            <input type="text" id="fullname"><br>

            <label for="password">Password：</label>
            <input type="password" id="password"><br>

            <p></p>

            <button  class="button button1" id="save">Save</button>
            <button  class="button button1" id="delete">Delete</button>
            <p id="Result"></p>

            <a href="index.php" class="button button1">Home Page</a>
        </div>
    </div>
    <div class="column middle">
        <?php
            require 'print_nurse_table.php';
        ?>
    </div>
</div>
    

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/JavaScript">
$(document).ready(function() {
    $("#save").click(function() {
        $.ajax({
            type: "POST",
            url: "addNurse_db.php",
            dataType: "json",
            data: {
                ID: $("#id").val(),
                Username: $("#username").val(),
                Password: $("#password").val(),
                Fullname: $("#fullname").val()                    
            },
            success: function(data) {
                if (data.Username) {
                    $("#Result").html('Nurse：' + data.Username + ' is saved successfully!');
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
            url: "deleteNurse_db.php",
            dataType: "json",
            data: {
                ID: $("#id").val(),
                Fullname: $("#fullname").val()                   
            },
            success: function(data) {
                if (data.Fullname) {
                    $("#Result").html('Nurse：' + data.Fullname + ' is deleted successfully!');
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

</html>
