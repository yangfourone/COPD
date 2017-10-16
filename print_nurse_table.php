<?php
$con = mysqli_connect('localhost','root','qcg444ntn','session_login');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"account");
$sql="SELECT * FROM account";
$result = mysqli_query($con,$sql);

echo "<table align=center>
<tr>
<th>ID</th>
<th>NickName</th>
<th>FullName</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['fullname'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);


?>