<!--g…
Run SQL query/queries on table QThHxJOKo8.War: Documentation
UPDATE War SET Construction_id=1 WHERE Timetaken=10;
UPDATE War SET Construction_id=2 WHERE Timetaken=9;
UPDATE War SET Construction_id=3 WHERE Timetaken=8;
UPDATE War SET Construction_id=4 WHERE Timetaken=7;
UPDATE War SET Construction_id=5 WHERE Timetaken=6;
UPDATE War SET Construction_id=6 WHERE Timetaken=5;
UPDATE War SET Construction_id=7 WHERE Timetaken=4;-->

<?php 
session_start();
$notpermanentusername = $_SESSION["usern"]; 

//$connectionn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
//mysqli_close($connectionn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.first{
  position: all;
}

body{
  background-image: url(https://wallpaperaccess.com/full/204728.jpg);
  background-repeat: no-repeat;
  background-color: #cccccc;
  height: 100%;
  
  background-repeat: no-repeat;
  background-size: cover;
  
}

table {
  font-family: arial, sans-serif;
  color: white;
  border-collapse: collapse;
  width: 50%;
  position: relative;
  
  }

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: rgba(0,0,0,0.5);
}
tr:nth-child(odd) {
  background-color: #122436;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #800000;
}

p {
  text-align: right;
  font-size:60px;
  margin-top: 0px;
  position: absolute;
  top: 10%;
  right: 3%;
  color: white;
}
</style>
</head>
<body id="body">



<?php
//function evolve(){
if (isset($_POST['stage1']))
{
  $nextstage = 1;
}
elseif (isset($_POST['stage2']))
{
  $nextstage = 2;
} 
elseif (isset($_POST['stage3']))
{
  $nextstage = 3;
} 
elseif (isset($_POST['stage4']))
{
  $nextstage = 4;
} 
elseif (isset($_POST['stage5']))
{
  $nextstage = 5;
} 
elseif (isset($_POST['stage6']))
{
  $nextstage = 6;
} 
elseif (isset($_POST['stage7']))
{
  $nextstage = 7;
} 
else
$nextstage=0;

if ($nextstage>0) {
        $connection = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
        if (!$connection) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $query_cost = mysqli_query($connection,"SELECT Cost FROM War WHERE Construction_id='$nextstage'");
        if ( $connection->affected_rows == 0 )
            {
              $message="MSG1";
             echo "<script> alert('$message'); </script>";
            }
            
        $row= $query_cost ->fetch_assoc(); 
        $developementcost=$row["Cost"];

        $query = "SELECT Money FROM Everything WHERE username = '$notpermanentusername' ";
        $query_money = mysqli_query($connection,$query);
        if (!$query_money) {
              die("Query failed: " .mysqli_error($connection) );
            }
        if ( $connection->affected_rows == 0 )
            {
                            $message="MSG3".$notpermanentusername.$query;

              echo "<script> alert('$message'); </script>";
            }

        $row=$query_money ->fetch_assoc();
        $sessionmoney=$row["Money"];

        //$developementcost = (int)$developementcost;
        //$developementcost = intval($developementcost);
        //$sessionmoney = intval($_SESSION["Money"])
        $newmoney = $sessionmoney-$developementcost;
        

        if ($developementcost<$sessionmoney) {

            $command = mysqli_query($connection,"INSERT INTO War_Country (username, Construction_id, completion_time) VALUES ('$notpermanentusername', $nextstage, now()) ;");
            if (!$command) {
              die("Query failed: " .mysqli_error($connection) );
            }
            $command = mysqli_query($connection,"UPDATE Everything SET Money=$newmoney WHERE username= '$notpermanentusername' ");
            if (!$command) {
              die("Query failed: " .mysqli_error($connection) );
            }
            mysqli_close($connection);
        }
        else {
          $message = "Your finantial status does not allow you this upgrade!  \\n $sessionmoney is less than $developementcost!";
          echo "<script>alert('$message');</script>";
        }
            

} // isset stage 1

//}

?>






<ul>
  <li><a class="active" href="nuclearreactordevelopement.php">Nuclear reactor developement</a></li>
  <li><a href="ncbmbdev.php">Nuclear bomb developement</a></li>
  <li><a href="quantumcomputerdevelopement.php">Quantum computer developement</a></li>
  <li><a href="armament.php">Armament</a></li>
  <li><a href="cyberattack.php">Cyber Attack</a></li>
  <li style="float:right"><a href="#about">Surrender</a></li>
</ul>

<table>
   <tr>
    
      <th>Construction Phase</th>
      <th>Completed</th>
      <th>Cost</th>
      <th>Time(s)</th>

<form method=post>
<div>
  <?php 
  $connection = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
        if (!$connection) {
          die("Connection failed: " . mysqli_connect_error());
        }

        $query = mysqli_query($connection,"SELECT completion_time, Construction_id FROM War_Country WHERE username='$notpermanentusername' and Construction_id = ( SELECT max(Construction_id) FROM War_Country WHERE username='$notpermanentusername') ");

        if ( $connection->affected_rows == 0 )
            {
                $current_phase = 0;
            }
        $row= $query ->fetch_assoc(); 
        $completion_time=$row["completion_time"];
        $current_phase = $row["Construction_id"];

if ($current_phase < 7){
        $button_name = "stage".($current_phase+1);
        $button_value = "Upgrade to phase".($current_phase+1);
}
else
{
        $button_name = "stage".($current_phase+1);
        $button_value = "No more phase to upgrade";
}
     echo '<input  type="submit" class="button" name="'.$button_name.'" value="'.$button_value.'">'; 

  ?>
  <!--
  <input  type="submit" class="button" name="stage1" value="Phase one">
  <input  type="submit" class="button" name="stage2" value="Phase two">
  <input  type="submit" class="button" name="stage3" value="Phase three">
  <input  type="submit" class="button" name="stage4" value="Phase four">
  <input  type="submit" class="button" name="stage5" value="Phase five">
  <input  type="submit" class="button" name="stage6" value="Phase six">
  <input  type="submit" class="button" name="stage7" value="Phase seven">
  -->
</div>
</form>      

    
  </tr>

<?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT Construction,Completed,Cost,Timetaken  FROM War";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["Construction"]. "</td><td>" . $row["Completed"] . "</td><td>"
. $row["Cost"]. "</td><td>" . $row["Timetaken"]."</tr></td>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
  ?>

</table>
<div>
<p id="Stoppwatch">Stoppwatch</p>
</div>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Dec 8, 2019 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("Stoppwatch").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("Stoppwatch").innerHTML = "End of the session";
  }
}, 1000);
</script>

<div class="logo">
    <h4><?php echo $_SESSION["usern"] ;?></h4>
  </div>
<div class="logo">
    <h4><?php echo $sessionmoney ;?></h4>
  </div>
  
  <div class="logo">
    <h4><?php echo $developementcost;?></h4>
  </div>
</body>
</html>
