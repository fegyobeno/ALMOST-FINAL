<?php 
session_start();
$connection =mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
$result = mysqli_query($connection,"SELECT * FROM Messaging WHERE Admin='hello'");
$rows = array();
$xd=1;
while ($row_message = mysqli_fetch_assoc($result)) 
{
    $rows[] = $row_message;
}
if(isset($_POST['btnAccess']))
{
	$_SESSION['xd']=$_POST['dropdownList'];
	


}
 $xd=$_SESSION['xd'];


if(isset($_POST['btnSendReply']) && $_POST['randomchecker']==$_SESSION['rand1'])
{	
	$idszar=$rows[$xd]['id'];
	$adminszar=$_POST["adminmessage"];
	$upload = mysqli_query($connection,"UPDATE Messaging SET Admin='$adminszar' WHERE id='$idszar'");
}
mysqli_close($connection);


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initaial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Process page</title>
	<link rel="stylesheet" type="text/css" href="adminsty.css">
	<script type="text/javascript" name="inp">document.getElementById("dropdownList").innerHTML;="<?php $phpvar="'+javavar+'";echo $phpvar;?>";</script>
</head>

<body>
<form id ="2"method="post"action="admin.php">
	<div id="transbox">
		<h1 class="user"></h1>
<div class="output">
	<p name="country1"><?php echo $rows[$xd]['Country']?></p>
	<p name="time1"><?php echo $rows[$xd]['Time']?></p>
	<p name="xddd"><?php echo $xd?></p>
<div class="outputbtnarea">
	<textarea readonly name="accessdata"  rows="15" cols="50"><?php echo $rows[$xd]['Message'] ?></textarea>
	<button type="Ssubmit" class="sendbutton" name="btnAccess">Access Data</button>
</div>
</div>
<div class="input">

	<textarea name="adminmessage" rows="15" cols="50"></textarea>
	<button type="Ssubmit" class="sendbutton" name="btnSendReply">Send reply</button>
</div>
	

		<!-- <p><?php echo $rows[1]['Country']?></p> -->
	<div class="countrymessages">
		<select name="dropdownList">
			<option id="opt1" value="0"><?php echo $rows[0]['Country']." ".$rows[0]['Time'] ?></option>
			<option id="opt2"value="1"><?php echo $rows[1]['Country']." ".$rows[1]['Time']?></option>
			<option id="opt3"value="2"><?php echo $rows[2]['Country']." ".$rows[2]['Time'] ?></option>
			<option id="opt4"value="3"><?php echo $rows[3]['Country']." ".$rows[3]['Time'] ?></option>
			<option id="opt5"value="4"><?php echo $rows[4]['Country']." ".$rows[4]['Time'] ?></option>
			<option id="opt6"value="5"><?php echo $rows[5]['Country']." ".$rows[5]['Time'] ?></option>
			<option id="opt7"value="6"><?php echo $rows[6]['Country']." ".$rows[6]['Time'] ?></option>
			<option id="opt8"value="7"><?php echo $rows[7]['Country']." ".$rows[7]['Time'] ?></option>
			<option id="opt9"value="8"><?php echo $rows[8]['Country']." ".$rows[8]['Time']?></option>
			<option id="opt10"value="9"><?php echo $rows[9]['Country']." ".$rows[9]['Time'] ?></option>
		</select>
		
	</div>		
	</div>
	
	<script type="text/javascript" value="messageJS">
		var messageJS = document.getElementById("dropdownList").value;
		
	</script>

	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>
	<?php
   $rand1=rand();
   $_SESSION['rand1']=$rand1;
  ?>

 <input type="hidden" value="<?php echo $rand1; ?>" name="randomchecker" />
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




		

		
	
<script src="sidebar.js"></script>
</form>
</body>
</html>