<?php
require 'connect.php'
mysqli_select_db($con,"user");
$sql="SELECT * FROM user";
$result = mysqli_query($con,$sql);

echo "<table align=center>
<tr>
<th>ID</th>
<th>FirstName</th>
<th>LastName</th>
<th>Sex</th>
<th>BMI</th>
<th>History</th>
<th>Drug</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['fname'] . "</td>";
    echo "<td>" . $row['lname'] . "</td>";
    echo "<td>" . $row['sex'] . "</td>";
    echo "<td>" . $row['bmi'] . "</td>";
    echo "<td>" . $row['history'] . "</td>";
    echo "<td>" . $row['drug'] . "</td>";
    echo "</tr>";
}
echo "<p>";
echo "<h2>Patient Information</h2>";
echo "</table>";
echo "<p>";
mysqli_close($con);
}
?>