<?php
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
</head>

<script src="js/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="css\myStyle.css">
<link rel="stylesheet" href="..\DataTables\DataTables-1.10.16\css\jquery.dataTables.min.css">
<script type="text/JavaScript" src="..\DataTables\DataTables-1.10.16\js\jquery.dataTables.min.js"></script>

<script type="text/JavaScript">

  $(document).ready(function(){
    var patientDataTable = $('#patientTable').DataTable();
    getPatientData();
    
    $("#NewPatient").click(function(){
      clear_add_table();
    })
    $("#patient_close").click(function(){
      $("#PatientManage").hide();
    })
    $("#patient_save").click(function() {
      post_data('add');
    })
    $("#patient_update").click(function() {
      post_data('update');
    })
    $("#patient_delete").click(function() {
      delete_data();
    })
    $(document).on("click", "tr[class='odd'],tr[class='even']", function(){
      var row = $(this).children('td:first-child').text();
      click_row(row);
    })
  });

  function getPatientData() {
    $.ajax({
      type : 'GET',
      url  : '../apiv1/user/getall',
      dataType: 'json',
      cache: false,
      success :  function(result)
      {
        if(result=='No data avaliable.'){
          alert('No data avaliable.');
          $("#patientTable").hide();
        }
        else{
          LoadPatientDataToTable(result);
        }
        $("#PatientManage").hide();
      }
    });
  }

  function LoadPatientDataToTable(patientData) {
    var patientDataTable = $('#patientTable').DataTable();
    patientDataTable.clear().draw(false);
    for (var i in patientData){
      patientDataTable.row.add([
        patientData[i].id,
        patientData[i].fname,
        patientData[i].lname,
        patientData[i].sex==1?'男':(patientData[i].sex==0?'女':null),
        patientData[i].bmi,
        patientData[i].drug,
        patientData[i].history,
        patientData[i].env_id,
        patientData[i].ble_id,
        patientData[i].watch_id
      ]).draw(false);
    }
    patientDataTable.columns.adjust().draw();
  }

  function delete_data() {
    $.ajax({
      type: "DELETE",
      url: "../apiv1/user/delete/" + $("#updateid").val(),
      dataType: "json",
      data: {                
      },
      success: function(data) {
        if (data=='ok') {
            alert('delete successfully');
        } 
        else {
            alert(data);
        }                   
        getPatientData();         
      },
      error: function(jqXHR) {
        alert("發生錯誤: " + jqXHR.status);
      }
    })
  }

  function post_data($action){
    get_medicine();
    get_case();
    $.ajax({
      type: "POST",
      url: "../apiv1/user/" + $action,
      dataType: "json",
      data: {
        ID: $("#" + $action + "id").val(),
        Password: $("#pwd").val(),
        FirstName: $("#fname").val(),
        LastName: $("#lname").val(),
        Sex: $("#sex").val(),
        BMI: $("#bmi").val(),
        History: $("#history").val(),
        Drug: $("#drug").val(),
        ENV_ID: $("#env_id").val(),
        BLE_ID: $("#ble_id").val(),
        Watch_ID: $("#watch_id").val()
      },
      success: function(data) {
        if (data=='ok') {
            alert($action + 'successfully');
        } 
        else {
            alert(data);
        }              
        getPatientData(); 
      },
      error: function(jqXHR) {
        alert("發生錯誤: " + jqXHR.status);
      }
    })
  }

  function get_medicine(){
    var medicine_selected=[];
    $("[name=medicine]:checkbox:checked").each(function(){
      medicine_selected.push($(this).val());
    });
    medicine_selected = medicine_selected + '';
    if(medicine_selected==''){
    	document.getElementById('drug').value = '["None"]';
    }
    else{
	    var drug_arr = medicine_selected.split(',');
        drug_arr = JSON.stringify(drug_arr);
	    document.getElementById('drug').value = drug_arr ;

	    //document.getElementById('drug').value = medicine_selected ;
    }
  }
  function get_case(){
    var case_selected=[];
    $("[name=case]:checkbox:checked").each(function(){
      case_selected.push($(this).val());
    });
    case_selected = case_selected + '';
    if(case_selected==''){
     	document.getElementById('history').value = '["None"]';
    }
    else{
        var history_arr = case_selected.split(',');
        history_arr = JSON.stringify(history_arr);
     	document.getElementById('history').value = history_arr ;

     	//document.getElementById('history').value = case_selected ;
    }
  }

  function click_row(row){
    if(row==''){

    }
    else{
      $.ajax({
        type: "GET",
        url: "../apiv1/user/getbyid/" + row,
        dataType: "json",
        data: {
        },
        success: function(data) {
          document.getElementById('updateid').value = data.id;
          document.getElementById('pwd').value = data.pwd;
          document.getElementById('fname').value = data.fname;
          document.getElementById('lname').value = data.lname;
          document.getElementById('sex').value = data.sex;
          document.getElementById('bmi').value = data.bmi;
          document.getElementById('env_id').value = data.env_id;
          document.getElementById('ble_id').value = data.ble_id;
          document.getElementById('watch_id').value = data.watch_id;
          data.history = JSON.parse(data.history);
          data.drug = JSON.parse(data.drug);

          //var history_arr = data.history.split(',');
          //var drug_arr = data.drug.split(',');
          
          $("input[name='medicine']").prop("checked", false);
          $("input[name='case']").prop("checked", false);
          for(var i in data.history){
            $("input[value='" + data.history[i] + "']").prop("checked", true);
          }
          for(var i in data.drug){
            $("input[value='" + data.drug[i] + "']").prop("checked", true);
          }
          
        },
        error: function(jqXHR) {
            alert("發生錯誤: " + jqXHR.status);
        }
      })
      $("#patient_delete").show();
      $("#patient_update").show();
      $("#patient_save").hide();
      $("#patient_close").show();
      $("#newid_label").hide();
      $("#pid_label").show();
      $("#addid").hide();
      $("#updateid").show();
      $("#PatientManage").show();
    }
  }
  

  function clear_add_table(){
    document.getElementById('updateid').value = '';
    document.getElementById('addid').value = '';
    document.getElementById('pwd').value = '';
    document.getElementById('fname').value = '';
    document.getElementById('lname').value = '';
    document.getElementById('sex').value = '';
    document.getElementById('bmi').value = '';
    document.getElementById('env_id').value = '';
    document.getElementById('ble_id').value = '';
    document.getElementById('watch_id').value = '';
    $("input[name='medicine']").prop("checked", false);
    $("input[name='case']").prop("checked", false);
    $("#patient_delete").hide();
    $("#patient_update").hide();
    $("#patient_save").show();
    $("#patient_close").show();
    $("#newid_label").show();
    $("#pid_label").hide();
    $("#addid").show();
    $("#updateid").hide();
    $("#PatientManage").show();
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
    <div class="container-fluid">
        <div class="download_table" align="right">
              <button onclick="window.location.href='Download_Patient_PDF.php'">PDF Download</button>
              <button onclick="window.location.href='Download_Patient_Excel.php'">EXCEL Download</button>&nbsp;
              &nbsp;<button id="NewPatient">New Data</button>
        </div>
	    <!-- /.container-fluid-->
	    <!-- Download Page -->
	    <!-- PatientManage-->
      <div class="edit_table" id="PatientManage" style="display:none; width: 100%">
        <h2 align="left" style="font-weight: bold; padding-left: 20px;">病患資料表</h2><br>
          <div class="row">
            <div class="column" align="right" style="padding: 0px 10px 0px 5px; margin: 0 auto 0 40px;">
              <label for="fname">姓氏：</label>
              <input type="text" id="fname"><br>

              <label for="lname">名字：</label>
              <input type="text" id="lname"><br>

              <label for="sex">性別：</label>
              <select id="sex" style="width: 77%;">
                <option value="1">男</option>
                <option value="0">女</option>
              </select> <br>          
            </div>

            <div class="column" align="right" style="padding: 0px 10px 0px 5px; margin: 0 auto 0 auto;" >
              <label for="addid" id="newid_label">帳號：</label>
              <input type="text" id="addid">
              
              <label for="updateid" id="pid_label">帳號：</label>
              <input type="text" id="updateid" disabled> <br>

              <label for="pwd">密碼：</label>
              <input type="password" id="pwd"> <br>

              <label for="bmi">BMI：</label>
              <input type="text" id="bmi"> <br>
            </div>

            <div class="column" align="right" style="padding: 0px 10px 0px 5px; margin: 0 auto 0 auto;">
              <label for="ble_id">BLE_ID：</label>
              <input type="text" id="ble_id"><br>

              <label for="env_id">ENV_ID：</label>
              <input type="text" id="env_id"><br>

              <label for="watch_id">Watch_ID：</label>
              <input type="text" id="watch_id"><br>
            </div>
          </div>
          <div class="row">
            <div class="column" align="left" style="padding: 0px 10px 0px 40px;">
              <br><h4 style="font-weight: bold;">服用藥物</h4>
            </div>
          </div>
          <div class="row">
            <div class="column" align="left" style="padding: 0px 10px 0px 80px;">
              <h5 style="font-weight: bold;">  吸入型</h5>
            </div>
          </div>
          <div class="row" align="center">
            <div class="column" align="left" style="margin: 0 auto 0 80px;" >
              <h5>β2致效劑(β2-agonists)</h5>
              <input name="medicine" type="checkbox" value="Fenoterol"> Fenoterol(骨骼肌輕微震顫)><br>
              <input name="medicine" type="checkbox" value="Salbutamol"> Salbutamol<br>
              <input name="medicine" type="checkbox" value="Formoterol"> Formoterol<br>
              <input name="medicine" type="checkbox" value="Indacaterol"> Indacaterol(咳嗽、鼻炎)<br>
              <input name="medicine" type="checkbox" value="Salmeterol"> Salmeterol(肌肉痙攣)<br>
            </div>
            <div class="column" align="left" style="margin: 0 auto 0 auto;">
              <h5>抗蕈毒鹼藥物(anticholinergic drugs)</h5>
              <input name="medicine" type="checkbox" value="IpratropiumBormide"> Ipratropium Bormide(咳嗽、視力模糊)<br>
              <input name="medicine" type="checkbox" value="Vilanterol"> Vilanterol<br>
              <input name="medicine" type="checkbox" value="Glycopyrronium"> Glycopyrronium(咳嗽、鼻炎)<br>
              <input name="medicine" type="checkbox" value="Tiotropium"> Tiotropium(咳嗽、視力模糊)<br>
              <input name="medicine" type="checkbox" value="Umeclidinium"> Umeclidinium<br>
            </div>
            <div class="column" align="left" style="margin: 0 auto 0 auto;">
              <h5>吸入型類固醇(inhaled corticosteroids)</h5>
              <input name="medicine" type="checkbox" value="Beclomethasone"> Beclomethasone<br>
              <input name="medicine" type="checkbox" value="Budesonide"> Budesonide(咳嗽)<br>
              <input name="medicine" type="checkbox" value="FluticasonePropionate"> Fluticasone Propionate<br>
            </div>
          </div>
          <div class="row">
            <div class="column" align="left" style="padding: 0px 10px 0px 80px;">
              <br><h5 style="font-weight: bold;">  口服型</h5>
            </div>
          </div>
          <div class="row">
            <div class="column" align="left" style="margin: 0 auto 0 80px;">
              <h5>抑制劑(Phosphodiesterase-4)</h5>
              <input name="medicine" type="checkbox" value="Roflumilast"> Roflumilast<br>
            </div>
            <div class="column" align="left" style="margin: 0 auto 0 auto;">
              <h5>茶鹼類(methylxanthines)</h5>
              <input name="medicine" type="checkbox" value="Aminophylline"> Aminophylline(肌肉抽筋)<br>
              <input name="medicine" type="checkbox" value="Theophylline"> Theophylline<br>
            </div>
            <div class="column" align="left" style="margin: 0 auto 0 auto;">
              <h5>口服刑類固醇(oral steroids)</h5>
            </div>
          </div>
          <div class="row">
            <div class="column" align="left" style="padding: 0px 10px 0px 40px;">
              <br><h4 style="font-weight: bold;">疾病史</h4>
            </div>
          </div>
          <div class="row">
            <div class="column" align="left" style="margin: 0 20px 0 80px;">
              <input name="case" type="checkbox" value="HeartDisease"> 心臟病<br>
            </div>
            <div class="column" align="left" style="margin: 0 20px 0 20px;">
              <input name="case" type="checkbox" value="Hypertension"> 高血壓<br>
              
            </div>
            <div class="column" align="left" style="margin: 0 20px 0 20px;">
              <input name="case" type="checkbox" value="Diabetes"> 糖尿病<br>
            </div>
            <div class="column" align="left" style="margin: 0 20px 0 20px;">
              <input name="case" type="checkbox" value="Arrhythmia"> 心律不整<br>
            </div>
            <div class="column" align="left" style="margin: 0 20px 0 20px;">
              <input name="case" type="checkbox" value="HeartFailure"> 心衰竭<br>
              
            </div>
            <div class="column" align="left" style="margin: 0 20px 0 20px;">
              <input name="case" type="checkbox" value="Stroke"> 中風<br>
            </div>
          </div>
          <div class="row" align="right">
            <div class="column" align="right" style="padding: 0px 10px 0px 5px; margin: 0 0 0 auto;" >
              <button  class="button2" id="patient_save">儲存</button>
              <button  class="button2" id="patient_delete">刪除</button>
              <button  class="button2" id="patient_update">更新</button>
              <button  class="button2" id="patient_close">取消</button>
           </div>
         </div>
         <div class="row" align="right">
            <textarea type="text" id="history" rows="3" cols="40" style="display: none;"></textarea>
            <textarea type="text" id="drug" rows="3" cols="40" style="display: none;"></textarea>
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
	                  <th>帳號</th>
	                  <th>名字</th>
	                  <th>姓氏</th>
	                  <th>性別</th>
	                  <th>BMI</th>
                    <th>藥物</th>
	                  <th>病例</th>
                    <th>Env_ID</th>
                    <th>BLE_ID</th>
                    <th>Watch_ID</th>
	              </tr>
	          </thead>
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
