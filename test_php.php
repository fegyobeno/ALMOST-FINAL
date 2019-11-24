<!--UPDATE `Everything` SET `Money` = '4500' WHERE `Everything`.`id` = 6;-->
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="10">
  <meta name="viewport" content="width=device-width, initaial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Process page</title>
  <link rel="stylesheet" type="text/css" href="testphp.css">
  <title>Country Matrix</title>
  <style>
table {
  font-family: arial, sans-serif;
  color: white;
  border-collapse: collapse;
  width: 100%;
  
  }

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #151719;
}
tr:nth-child(odd) {
  background-color: #122436;
}

</style>
</head>
<body>

  
  <div id="transbox">
    <h1 class="user"></h1>  

    <table>
  <tr>
    
      <th>id</th>
      <th>Counry</th>
      <th>GDP</th>
      <th>Money</th>
      
    
  </tr>
  <?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id,username,GDP,Money  FROM Everything";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"] . "</td><td>"
. $row["GDP"]. "</td><td>" . $row["Money"]."</tr></td>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
  ?>
</table>

</div>
<nav>
  <div class="logo">
    <h4>Admin</h4>
  </div>
  
<ul class="nav-links">
  <li><a href="admin.php">Home</a></li>
  <li><a href="test_php.php">Country Matrix</a></li>
  <li><a href="CommunicationPanel.php">Comm. pannel</a></li>
  
</ul>
<div class="burger">
  <div class="line1"></div>
  <div class="line2"></div>
  <div class="line3"></div>
</div>
</nav>
  </div>

  
<script src="sidebar.js"></script>
  
</body>
</html>