<!DOCTYPE html>
<?php
session_start();
if(empty($_SESSION['account'])){
  header("Location: index.php"); 
}
else{
}
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
  //var table = $('#activityTable').DataTable();
  $("#time_select").change(function(){
    $.ajax({
    type : 'GET',
    url : '../apiv1/activity/' + $("#time_select").val(),
    dataType: 'json',
    result :{
    },
    success :  function(result)
        {
            //pass data to datatable
            console.log(result); // just to see I'm getting the correct data.
            $('#activityTable').DataTable({
                "aaData": result, //here we get the array data from the ajax call.
            });
        }
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
            <span class="nav-link-text">COPD首頁</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Patient">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" id="test">病患資料</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="PatientPage.php">Table</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Environment">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" id="test">環境資料</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="EnvironmentPage.php">Table</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Daily">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseDailyPages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" id="test">每日統計</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseDailyPages">
            <li>
              <a href="DailyPage.php">Table</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Activity">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseActivityPages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text" id="test">活動紀錄</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseActivityPages">
            <li>
              <a href="ActivityPage.php">Table</a>
            </li>
          </ul>
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
    <!-- click activity record -->
    <div class="edit_table" id="ActivityRecord" >
      <h2>活動紀錄</h2>
      <br>

      <label>姓名：</label><label id="name">132</label><br>
      <label>年齡：</label><label id="age">321</label><br>
      <label>前測 舒張壓：</label><label id="before_sbp">321</label><label>hmmg 收縮壓：</label><label id="before_dbp">70</label><label>hmmg</label><br>
      <label>後測 舒張壓：</label><label id="after_sbp">80</label><label>hmmg 收縮壓：</label><label id="after_dbp">120</label><label>hmmg</label><br>
      <label>運動時間：</label><label id="exercise_time">27分24秒</label><br>
      <label>高強度運動時間：</label><label id="h_i_time">2分</label><br>
      
    </div>
    <!-- Datatable -->
    <br>
    <div class="container-fluid">
        <select id="time_select">
          <option value="getallweek">本周</option>
          <option value="getallmonth">本月</option>
          <option value="getall">全部</option>
        </select>
        <select id="human">
          <option value="1"></option>
          <option value="2"></option>
        </select>
        <button onclick="window.location.href='Download_Activity_PDF.php'" style="margin-left: 1260px">PDF Download</button>
        <button onclick="window.location.href='Download_Activity_Excel.php'">EXCEL Download</button>
    </div>
    <br>
    <div class="container-fluid">
	    <!-- /.container-fluid-->
	    <!-- Download Page -->
	    <!-- EnvDataTable-->
        <div id="datatable_activity_visible">
          <table id="activityTable" class="display" cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>編號</th>
                      <th>帳號</th>
                      <th>步數</th>
                      <th>開始時間</th>
                      <th>結束時間</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                      <th>編號</th>
                      <th>帳號</th>
                      <th>步數</th>
                      <th>開始時間</th>
                      <th>結束時間</th>
                  </tr>
              </tfoot>
              
          </table>
        </div>
	    <!-- PatientManage-->
	    <!-- PatientDataTable-->
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
