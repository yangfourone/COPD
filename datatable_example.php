<?php
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


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/bootstrap-table.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/Chart.bundle.js"></script>
<script type="text/javascript" src="js-datatable-1.0.4/js/datatable.js"></script>
<link rel="stylesheet" href="js-datatable-1.0.4/css/bootstrap-table.css">
<link rel="stylesheet" href="js-datatable-1.0.4/css/datatable.css">

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
                <td>'.$row1['pm2.5'].'</td>
                <td>'.$row1['uv'].'</td>
            </tr>
            ';
        }
        ?>
        <tr>
            <td>4</td>
            <td>40.4</td>
            <td>6.5344</td>
            <td>9.32</td>
            <td>3.232</td>
        </tr>
        <tr>
            <td>5</td>
            <td>60.2</td>
            <td>3.232</td>
            <td>9.32</td>
            <td>6.5344</td>
        </tr>
        <tr>
            <td>6</td>
            <td>20.6</td>
            <td>9.32</td>
            <td>3.232</td>
            <td>6.5344</td>
        </tr>
    </tbody>
</table>

</body>
</html>