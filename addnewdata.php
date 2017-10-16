<!DOCTYPE html>
<html>
<style type="text/css"> 
input, select {
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}
</style>

<style>
.text {color:#3c3c3c; font-size:24px; text-align:left}

* {
    box-sizing: border-box;
}

/* Style the input */
input[type=text], select {
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

div {
    border-radius: 5px;
    /* 底色有點淺藍
    background-color: #f2f2f2;
    */
    padding: 5px;
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
    background-color: #333;
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
    width: 25%;
    height: 100%;
}

/* Middle column */
.column.middle {
    width: 75%;
}

.look {
    background-color: #3c3c3c;
    text-align: center;
    color: white;
    padding: 5px 5px;
    font-size: 25px;
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

/*
.button {
    border: none;
    color: #3c3c3c;
    padding: 5px 5px;
    text-align: left;
    background-color: #f2f2f2;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    width: 100%;
}

.button1 {
    color: #0000E3;
}*/

</style>

<body>
<div class="header">
<header>COPD Manage System</header>
</div>

<div class="row">
    <div class="column side">
        <h1 class="look">New Patient</h1>

        <div>
        <label for="id">User's ID：</label>
        <input type="text" id="id"><br>

        <label for="fname">First Name：</label>
        <input type="text" id="fname"><br>

        <label for="lname">Last Name：</label>
        <input type="text" id="lname"><br>

        <label for="sex">User's Sex：</label>
        <input type="text" id="sex"><br>

        <label for="bmi">User's BMI：</label>
        <input type="text" id="bmi"><br>

        <label for="history">Health History：</label>
        <input type="text" id="history"><br>

        <label for="drug">User's Drug Info：</label>
        <input type="text" id="drug"><br>

        <p></p>

        <button  class="button button1" id="save">Save</button>
        <button  class="button button1" id="delete">Delete</button>
        <p id="Result"></p>

        <a href="datapage.php" class="button button1">Previous Page</a>
        </div>
    </div>
    <div class="column middle">
        <?php
            require 'print_table.php';
        ?>
    </div>
</div>


<div class="footer">
    <p>NTUST MIT LAB</p> 
</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/JavaScript">

$(document).ready(function() {
    $("#save").click(function() {
        $.ajax({
            type: "POST",
            url: "addnewdata_db.php",
            dataType: "json",
            data: {
                ID: $("#id").val(),
                Firstname: $("#fname").val(),
                Lastname: $("#lname").val(),
                Sex: $("#sex").val(),
                BMI: $("#bmi").val(),
                History: $("#history").val(),
                Drug: $("#drug").val()                    
            },
            success: function(data) {
                if (data.Firstname) {
                    $("#Result").html('Patient：' + data.Firstname + ' is saved successfully!');
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
            url: "deletedata_db.php",
            dataType: "json",
            data: {
                ID: $("#id").val(),
                Firstname: $("#fname").val()                   
            },
            success: function(data) {
                if (data.Firstname) {
                    $("#Result").html('Patient：' + data.Firstname + ' is deleted successfully！');
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


