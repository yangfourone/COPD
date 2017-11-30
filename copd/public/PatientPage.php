<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>COPD Manage System</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <!--   <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">   -->
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<script src="jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="css\myStyle.css">
<link rel="stylesheet" href="..\DataTables\DataTables-1.10.16\css\jquery.dataTables.min.css">
<script type="text/JavaScript" src="..\DataTables\DataTables-1.10.16\js\jquery.dataTables.min.js"></script>

<script type="text/JavaScript">
$(document).ready(function(){

    $("#patient_close").click(function(){
    	$("#PatientManage").animate({
          height: 'hide'
        });
    });

    $("#NewPatient").click(function(){
      document.getElementById('pid').value = '';
      document.getElementById('fname').value = '';
      document.getElementById('lname').value = '';
      document.getElementById('sex').value = '';
      document.getElementById('bmi').value = '';
      document.getElementById('history').value = '';
      document.getElementById('drug').value = ''; 
      $("#patient_delete").hide();
      $("#patient_update").hide();
      $("#patient_save").show();
      $("#patient_close").show();
      $("#patient_clean").show();
      $("#PatientManage").animate({
          height: 'show'
        });
    })

    $("#patient_clean").click(function(){
      document.getElementById('pid').value = '';
      document.getElementById('fname').value = '';
      document.getElementById('lname').value = '';
      document.getElementById('sex').value = '';
      document.getElementById('bmi').value = '';
      document.getElementById('history').value = '';
      document.getElementById('drug').value = ''; 
    });

    $("#patient_save").click(function() {
        $.ajax({
            type: "POST",
            url: "addpatientdata_db.php",
            dataType: "json",
            data: {
                ID: $("#pid").val(),
                FirstName: $("#fname").val(),
                LastName: $("#lname").val(),
                Sex: $("#sex").val(),
                BMI: $("#bmi").val(),
                History: $("#history").val(),
                Drug: $("#drug").val()
            },
            success: function(data) {
                if (data.FirstName) {
                    $("#patient_Result").html('Patient：' + data.FirstName + ' is saved successfully!');
                } else {
                    $("#patient_Result").html(data.msg);
                }                   
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        
    })

    $("#patient_update").click(function() {
        $.ajax({
            type: "POST",
            url: "updatePatientData_db.php",
            dataType: "json",
            data: {
                ID: $("#pid").val(),
                FirstName: $("#fname").val(),
                LastName: $("#lname").val(),
                Sex: $("#sex").val(),
                BMI: $("#bmi").val(),
                History: $("#history").val(),
                Drug: $("#drug").val()
            },
            success: function(data) {
                if (data.FirstName) {
                    $("#patient_Result").html('Patient：' + data.FirstName + ' is UPDATE successfully!');
                } else {
                    $("#patient_Result").html(data.msg);
                }                   
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        
    })
    
    $("#patient_delete").click(function() {
        $.ajax({
            type: "POST",
            url: "deletepatientdata_db.php",
            dataType: "json",
            data: {
                ID: $("#pid").val(),
                FirstName: $("#fname").val()                  
            },
            success: function(data) {
                if (data.FirstName) {
                    $("#patient_Result").html('Patient：' + data.FirstName + ' is deleted successfully！');
                } else {
                    $("#patient_Result").html(data.msg);
                }                   
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        
    })

    $.ajax({
    type : 'POST',
    url  : 'datatable_patient.php',
    dataType: 'json',
    cache: false,
    success :  function(result)
        {
            //pass data to datatable
            console.log(result); // just to see I'm getting the correct data.
            $('#patientTable').DataTable({
                "aaData": result, //here we get the array data from the ajax call.
            });
        }
    });
    $(document).on("click", "tr[class='even']", function(){
        //var edit_target_id = $(this).children('td:first-child').text();
        $.ajax({
            type: "POST",
            url: "GetEditTableClickData.php",
            dataType: "json",
            data: {
                ID: $(this).children('td:first-child').text(),              
            },
            success: function(data) {
                document.getElementById('pid').value = data.id;
                document.getElementById('fname').value = data.fname;
                document.getElementById('lname').value = data.lname;
                document.getElementById('sex').value = data.sex;
                document.getElementById('bmi').value = data.bmi;
                document.getElementById('history').value = data.history;
                document.getElementById('drug').value = data.drug;
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        $("#patient_delete").show();
        $("#patient_update").show();
        $("#patient_save").hide();
        $("#patient_close").show();
        $("#patient_clean").show();

        $("#PatientManage").animate({
          height: 'show'
        });
    });
    $(document).on("click", "tr[class='odd']", function(){
        //var edit_target_id = $(this).children('td:first-child').text();
        $.ajax({
            type: "POST",
            url: "GetEditTableClickData.php",
            dataType: "json",
            data: {
                ID: $(this).children('td:first-child').text(),              
            },
            success: function(data) {
                document.getElementById('pid').value = data.id;
                document.getElementById('fname').value = data.fname;
                document.getElementById('lname').value = data.lname;
                document.getElementById('sex').value = data.sex;
                document.getElementById('bmi').value = data.bmi;
                document.getElementById('history').value = data.history;
                document.getElementById('drug').value = data.drug;
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        })
        $("#patient_delete").show();
        $("#patient_update").show();
        $("#patient_save").hide();
        $("#patient_close").show();
        $("#patient_clean").show();

        $("#PatientManage").animate({
          height: 'show'
        });
    });
});

    

</script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="homepage.php">Welcome COPD Manage System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="HomePage">
          <a class="nav-link" href="homepage.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">HomePage</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Patient">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" id="test">Patient</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a id="print_patientTable">Table</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Environment">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" id="test">Environment</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="EnvironmentPage.php">Table</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exercise">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" >Exercise</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a id="print_exerciseTable">Table</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
       <text align="text-center" style="margin: auto; color:yellow; padding-right: 10px" id="login_msg">Hello! <?php echo $_SESSION['account'] ?></text>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>


<!-- center   -->

  <div class="content-wrapper" style="padding-left: 5px">
    <div class="container-fluid">
        <div class="download_table" align="right">
              <button onclick="window.location.href='Download_Patient_PDF.php'">PDF Download</button>
              <button onclick="window.location.href='Download_Patient_Excel.php'">EXCEL Download</button>&nbsp;
              &nbsp;<button id="NewPatient">New Data</button>
            <br></br>
        </div>
	    <!-- /.container-fluid-->
	    <!-- Download Page -->
	    <!-- PatientManage-->
      <div class="edit_table" id="PatientManage" style="display:none">
        <h2 align="center">Edit The Patient Data</h2>
        <p></p>
          <div class="row">
            <div class="column cleft" align="right">
              <label for="pid">User's ID：</label>
              <input type="text" id="pid"><br>

              <label for="fname">FirstName：</label>
              <input type="text" id="fname"><br>

              <label for="lname">LastName：</label>
              <input type="text" id="lname"><br>

              <label for="sex">Sex：</label>
              <input type="text" id="sex"><br>

              <label for="bmi">BMI：</label>
              <input type="text" id="bmi"><br>
            </div>

            <div class="column cright" align="right">
              <label for="history">History：</label>
              <textarea type="text" id="history" rows="3" cols="60"></textarea><br>
              <label for="drug">Drug：</label>
              <textarea type="text" id="drug" rows="3" cols="60"></textarea><br>

              <button  class="button2" id="patient_save">Save</button>
              <button  class="button2" id="patient_delete">Delete</button>
              <button  class="button2" id="patient_update">Update</button>
              <button  class="button2" id="patient_clean">Clean</button>
              <button  class="button2" id="patient_close">Close</button>
            </div>
            
          </div>
          <p>
          <h5 id="patient_Result" align="right" style="color:red"></h5>
      </div>
      <br>
	    <!-- PatientDataTable-->
	    <div id="datatable_patient_visible">
	      <table id="patientTable" class="display" cellspacing="0" width="100%" >
            
	          <thead>
	              <tr>
	                  <th>ID</th>
	                  <th>FirstName</th>
	                  <th>LastName</th>
	                  <th>Sex</th>
	                  <th>BMI</th>
	                  <th>History</th>
	                  <th>Drug</th>
	              </tr>
	          </thead>
	          <tfoot>
	              <tr>
	                  <th>ID</th>
	                  <th>FirstName</th>
	                  <th>LastName</th>
	                  <th>Sex</th>
	                  <th>BMI</th>
	                  <th>History</th>
	                  <th>Drug</th>
	              </tr>
	          </tfoot>
	          
	      </table>
          
	    </div>
	    <!-- /.content-wrapper-->
	    <footer class="sticky-footer">
	      <div class="container">
	        <div class="text-center">
	          <small>Copyright © Your Website 2017</small>
	        </div>
	      </div>
	    </footer>
	    <!-- Scroll to Top Button-->
	    <a class="scroll-to-top rounded" href="#page-top">
	      <i class="fa fa-angle-up"></i>
	    </a>
	    <!-- Logout Modal-->
	    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content">
	          <div class="modal-header">
	            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
	            <button class="close" type="button" data-dismiss="modal" aria-label="Close" >
	              <span aria-hidden="true">×</span>
	            </button>
	          </div>
	          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
	          <div class="modal-footer">
	            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
	            <a class="btn btn-primary" href="index.php">Logout</a>
	          </div>
	        </div>
	      </div>
	    </div>
	    <!-- Bootstrap core JavaScript-->
	    <script src="vendor/jquery/jquery.min.js"></script>
	    <script src="vendor/popper/popper.min.js"></script>
	    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	    <!-- Core plugin JavaScript-->
	    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	    <!-- Page level plugin JavaScript-->
	    <script src="vendor/chart.js/Chart.min.js"></script>
	    <script src="vendor/datatables/jquery.dataTables.js"></script>
	    <!-- <script src="vendor/datatables/dataTables.bootstrap4.js"></script> -->
	    <!-- Custom scripts for all pages-->
	    <script src="js/sb-admin.min.js"></script>
	    <!-- Custom scripts for this page-->
	    <script src="js/sb-admin-datatables.min.js"></script>
	    <script src="js/sb-admin-charts.min.js"></script>
    </div>
</body>

</html>