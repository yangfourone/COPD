<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
session_start();
if(empty($_SESSION['account'])){
  header("Location: index.php"); 
}
else{
}
?>
<!DOCTYPE html>
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

  <script src="js/jquery-1.11.3.min.js"></script>
  <link rel="stylesheet" href="css\myStyle.css">
  <link rel="stylesheet" href="..\DataTables\DataTables-1.10.16\css\jquery.dataTables.min.css">
  <script type="text/JavaScript" src="..\DataTables\DataTables-1.10.16\js\jquery.dataTables.min.js"></script>
</head>

<script type="text/JavaScript">
	$(document).ready(function(){
    initial_date();

	  var envDataTable = $('#evnTable').DataTable({
      "order": [[ 6, "desc" ]]
    });
	  getEnvData();

    $("#time_select").change(function(){
      getEnvData();
    })
    $("#env_date").change(function(){
      document.getElementById('start_time').value = $("#env_date").val() + " 00:00:00";
      document.getElementById('end_time').value = $("#env_date").val() + " 23:59:59";
      getEnvData();
    })
    $("#Download").click(function(){
      $("#Download_Table").toggle();
    })
    $("#Env_PDF_Download").click(function(){
      if ($("#download_start_time").val()==''||$("#download_end_time").val()==''){
        alert("日期不能為空!");
      }
      else if($("#download_start_time").val() > $("#download_end_time").val()){
        alert("開始時間不能大於結束時間!");
      }
      else{
        document.location.href="Download_Env_zip.php?start_time=" + $("#download_start_time").val() + "&end_time=" + $("#download_end_time").val() + "&type=PDF";
      }
    })
    $("#Env_Excel_Download").click(function(){
      if ($("#download_start_time").val()==''||$("#download_end_time").val()==''){
        alert("日期不能為空!");
      }
      else if($("#download_start_time").val() > $("#download_end_time").val()){
        alert("開始時間不能大於結束時間!");
      }
      else{
        document.location.href="Download_Env_zip.php?start_time=" + $("#download_start_time").val() + "&end_time=" + $("#download_end_time").val() + "&type=Excel";
      }
    })
	});

	function LoadEnvDataToTable(envData){
	  var envDataTable = $('#evnTable').DataTable();
		envDataTable.clear().draw(false);
		for (var i in envData) {
      envDataTable.row.add([
        envData[i].id,
        envData[i].deviceid,
        envData[i].temperature,
        envData[i].humidity,
        envData[i].pm25,
        envData[i].uv,
        envData[i].datetime
      ]).draw(false);
    }
		envDataTable.columns.adjust().draw();
	}

  function getEnvData() {
    $.ajax({
      type : 'GET',
      url  : '../apiv1/env/getbytime',
      dataType: 'json',
      data: {
        start_time: $("#start_time").val(),
        end_time: $("#end_time").val(),
      },
      cache: false,
      success :  function(result){
        console.log(result);
        $("#datatable_env_visible").show();
        LoadEnvDataToTable(result);
      },
      error: function(jqXHR) {
        alert("選取的日期（" + $("#env_date").val() + "）沒有資料");
        $("#datatable_env_visible").hide();
      }
    });
  }
	 
  function initial_date(){
    var today = new Date();
    if ((today.getMonth()+1)<10){
      if(today.getDate()<10){
        document.getElementById('env_date').value = today.getFullYear() + "-0" + (today.getMonth()+1) + "-0" + today.getDate();
      }
      else{
        document.getElementById('env_date').value = today.getFullYear() + "-0" + (today.getMonth()+1) + "-" + today.getDate();
      }
    }
    else{
      if(today.getDate()<10){
        document.getElementById('env_date').value = today.getFullYear() + "-" + (today.getMonth()+1) + "-0" + today.getDate();
      }
      else{
        document.getElementById('env_date').value = today.getFullYear() + "-" + (today.getMonth()+1) + "-" + today.getDate();
      }
    }
    document.getElementById('start_time').value = $("#env_date").val() + " 00:00:00";
    document.getElementById('end_time').value = $("#env_date").val() + " 23:59:59";
  }

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
            <i class="fa fa-fw fa-windows"></i>
            <span class="nav-link-text">COPD首頁</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Patient">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-child"></i>
            <span class="nav-link-text" id="test">病患資料</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="PatientPage.php">Patient</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Environment">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-bank"></i>
            <span class="nav-link-text" id="test">環境資料</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="EnvironmentPage.php">Environment</a>
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
              <a href="DailyPage.php">Daily</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Activity">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseActivityPages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-bar-chart-o"></i>
            <span class="nav-link-text" id="test">活動紀錄</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseActivityPages">
            <li>
              <a href="ActivityPage.php">Activity</a>
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
    <div class="container-fluid">
      <div align="right">
        顯示資料日期：<input type="date" id="env_date">&nbsp;&nbsp;
        <button id="Download">下載</button>
        <input type="text" id="start_time" style="display: none;">
        <input type="text" id="end_time" style="display: none;">
      </div>
      <div id="Download_Table" class="modal" align="center" style="display: none;">
        <div class="edit_table" align="center" style="width: 90%; padding-bottom: 20px; border: none;">
          <h4 align="center">檔案下載</h4><br>
          開始時間：<input type="date" id="download_start_time"><br></br>
          結束時間：<input type="date" id="download_end_time"><br>
          <!--<select id="time_select">
            <option value="getbytime/week">近一週</option>
            <option value="getall">全部</option>
            <option value="getbytime/month">本月</option>
          </select>-->
          <br>
          <button id="Env_PDF_Download" style="width: 40%">PDF 下載</button>&nbsp;&nbsp;
          <button id="Env_Excel_Download" style="width: 40%">EXCEL 下載</button>
        </div>
      </div>
    </div><br>
	    <!-- /.container-fluid-->
	    <!-- Download Page -->
	    <!-- EnvDataTable-->
        <div id="datatable_env_visible">
          <table id="evnTable" class="display " cellspacing="0" width="100%">
              <thead>
                  <tr>
                      <th>編號</th>
                      <th>裝置編號</th>
                      <th>溫度</th>
                      <th>濕度</th>
                      <th>PM2.5</th>
                      <th>紫外線指數</th>
                      <th>時間</th>
                  </tr>
              </thead>
          </table>
        </div>
	    <!-- PatientManage-->
	    <!-- PatientDataTable-->
	    <!-- /.content-wrapper-->
	    <footer class="sticky-footer">
	      <div class="container">
	        <div class="text-center">
	          <small>COPD Walk © 2018</small>
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
  </div>
</body>

</html>
