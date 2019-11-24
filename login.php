<?php
session_start();
$username = $_POST['user'];
$password = $_POST['pass'];
$username = stripcslashes($username);
$password = stripcslashes($password);
$db = mysqli_connect("remotemysql.com","QThHxJOKo8","6gAhstQfGc","QThHxJOKo8");
$result = mysqli_query($db,"select * from Everything where username = '$username' and password= '$password'")
        or die("Failed to query database " .mysqli_error());
$row = mysqli_fetch_array($result);
$error = "";
$success = "";
$_SESSION["id"]=$row['id'];
if(isset($_POST['Submit'])){
    
 if($row['username'] == "Admin" && $row['password'] == $password && ($username != "" && $password != ""))
 {
header("Location:admin.php");
 }
elseif ($row['username'] == $username && $row['password'] == $password && ($username != "" && $password != "")){
    $error = "";
    $success = "Welcome ".$row['username'];
    header("Location:process.php");
    $_SESSION["usern"]=$row['username'];

  }
 
else{
  $error = "Invalid Username or Password!";
  $success = "";
}
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">

  </head>
  <body>
    <div id="transbox">
      <div id="login-box"> 
        <div id="Incorrect">
        <p class="error"><?php echo $error; ?></p><p class="success"><?php echo $success; ?></p>
        </div>
        <form method="POST">
        <h1>Login</h1> 
        <div id="textbox">
          <i class="fas fa-user"></i>
        
         
          <input type="text" id="user" name="user" placeholder="Username" />
      
      </div>
      <div id="textbox">
        <i class="fas fa-lock"></i>
        
         
          <input type="password" id="pass" name="pass" placeholder="Password" />
      </div>

       
          <label></label>
          <input type="Submit" id="btn" name="Submit" value="LOGIN" />
      
        </form>
    </div>
  </div>
  </body>
</html>
