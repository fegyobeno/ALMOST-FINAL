<!--UPDATE `Everything` SET `Money` = '4500' WHERE `Everything`.`id` = 6;-->
<?php
session_start(); 
 ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="refresh" content="10">
  <meta name="viewport" content="width=device-width, initaial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Process page</title>
  <link rel="stylesheet" type="text/css" href="usercountrymatrixst.css">
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
    <div class="inf">
      <p>Country: <?php echo $_SESSION["usern"] ?></p>
      <p>GDP: <?php echo $_SESSION["GDP"] ?></p>
      <p>Money: <?php echo $_SESSION["Money"] ?></p>

    

  <?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT id,username,GDP,Money  FROM Everything";
$result = $conn->query($sql);
  $idnum=$_SESSION["id"];


if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
  if ($row["username"] == $_SESSION["usern"]) {
   
  
  $_SESSION["GDP"]=$row["GDP"];
  $_SESSION["Money"]=$row["Money"];
  

//    echo  $row["username"] 
// . $row["GDP"] . $row["Money"];


}
}


} else { echo "0 results"; }
$conn->close();
  ?>


</div>
</div>
<nav>
  <div class="logo">
    <h4><?php echo $_SESSION["usern"] ;?></h4>
  </div>
  
<ul class="nav-links">
  <li><a href="process.php">Home</a></li>
  <li><a href="usercountrymatrix.php">Country Matrix</a></li>
  <li><a href="">Comm. pannel</a></li>
  
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