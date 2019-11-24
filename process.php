<?php 
session_start();
$connectionn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
$countdb = mysqli_query($connectionn,"SELECT count FROM Messaging WHERE id=1");
$countdb=mysqli_fetch_array($countdb);
$count = intval($countdb[0]);

mysqli_close($connectionn);
if(isset($_POST['btnSend']) && $_POST['randcheck']==$_SESSION['rand'])
{
	if($count>0)
	{
		$messTime=date("H:i:s");
		$messCountry=$_SESSION['usern'];
		$enteredmess=$_POST['message'];
		$enteredmessage=stripcslashes($enteredmess);
		$messAdmin="hello";
		$connection = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
		$command = mysqli_query($connection,"UPDATE Messaging SET Time='$messTime',Country='$messCountry',Message='$enteredmessage',Admin='$messAdmin' WHERE id=11-'$count'");
		$command2=mysqli_query($connection,"UPDATE Messaging SET count='$count'-1 WHERE id=1");
		if (!$connection) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		mysqli_close($connection);
		$count--;

	}
	else
	{
		if(isset($_POST['btnSend'])){
		$messTime=date("H:i:s");
		$messCountry=$_SESSION['usern'];
		$enteredmess=$_POST['message'];
		$enteredmessage=stripcslashes($enteredmess);
		$messAdmin="hello";
		$connection = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
		$command = mysqli_query($connection,"INSERT INTO Messaging (Time,Country,Message,Admin,count) 
			VALUES('$messTime','$messCountry','$enteredmessage','$messAdmin','0')");
		if (!$connection) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		mysqli_close($connection);
		
		}
	}
	
	
}
 ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,
	initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Process page</title>
	<link rel="stylesheet" type="text/css" href="procest.css">
	<script defer src="process.js"></script>

	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>

</head>
<body>
	<div id="transbox">
		<h1 class="user"><?php echo $count?></h1>		
		<button class="openbutton" data-modal-target="#modal" >Send Message</button>
  <div class="modal" id="modal">
  	<form method="post" action="process.php" enctype="multipart/form-data" autocomplete="off">
  		<?php
   $rand=rand();
   $_SESSION['rand']=$rand;
  ?>
 <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div class="modal-header">
      <div class="title">Send Message To HQ</div>
      <button data-close-button class="close-button">&times;</button>
    </div>
    <div class="modal-body">
    	<textarea id="message" name="message" placeholder="Write a message!..." rows="10" cols="55"></textarea>
    </div>
    <button type ="submit" class="sendbutton" name="btnSend">Send</button>
  </div>
</form>
  <div id="overlay"></div>
  <div class="countrymessages">
 <table>
  <tr>
    
      <th>Time</th>
      <th>Admin</th>
     <th>Message</th>
     
      
    
  </tr>
  <?php 
  $conn = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id,Time,Admin,Message,Country  FROM Messaging";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	if($row["Admin"] != "hello"&& $row["Country"] == $_SESSION['usern']){
echo "<tr><td>" . $row["Time"]. "</td><td>" . $row["Admin"] . "</td><td>". "<ul><a id='werde' onclick=clickFunction()>". $row["Message"]. "</a></ul>"."</tr></td>";
$_SESSION['mssg']= $row['Message'];


}
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
  ?>

<script>
	function clickFunction() {
		document.getElementById("val").innerHTML = "<?php echo $_SESSION['mssg'] ?>";
	}
</script>

</table>
	</div>		

  <div class="recieved">
  	<textarea  id="val" readonly rows="15" cols="50" ></textarea>  	
  </div>
		

	
	<!-- <div id="imagebox">
		<img src="data:image/png;base64,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">
	</div> -->
</div>

<nav>
	<div class="logo">
		<h4><?php echo $_SESSION["usern"] ;?></h4>
	</div>
	


<ul class="nav-links">
  <li><a href="process.php">Home</a></li>
  <li><a href="usercountrymatrix.php">Country Matrix</a></li>
  <li><a href="nuclearreactordevelopement.php">Evolution</a></li>
  
</ul>
<div class="burger">
	<div class="line1"></div>
	<div class="line2"></div>
	<div class="line3"></div>
</div>
</nav>


		

		
	
<script src="sidebar.js"></script>

	
</body>
</html>