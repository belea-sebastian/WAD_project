<?php

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>
		BicycleHouse
   </title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" type="text/css" href="css/login2.css">
  
</head>


<body>
   <div class="form-box">
      <img src="../images/user-icon.png">
      <h1>Sign In</h1>

      <form action="login.php" method="POST" class="form-group">
         <i class="fas fa-user fa-2x cust"></i>
         <input name="username" type="text" class="input-field" placeholder="Username" required="">
         <i class="fas fa-key fa-2x"></i>
         <input name="password" type="password"  class="input-field" placeholder="Password" required="">
         <button name = "submit_btn" type="submit" class="submit-btn">Sign In</button>
         <input type="button" value="Home" class="submit-btn2" onclick="window.location='index.php';">
      </form>
      
   </div>
   <?php
   session_start();
   if(isset($_POST['submit_btn']))
   {
     $username = $_POST['username'];
     $password = $_POST['password'];
     $_SESSION['first_name'] = $username;
     $password = md5($password);

     $cookie_name = "user";
     $cookie_value = $username;
     setcookie($cookie_name, $cookie_value, time() + 3600, "/");    

     $db = mysqli_connect("localhost","root","","accounts");
     $sql = "select * from users WHERE username = '$username' and password = '$password' ";

     $result = mysqli_query($db,$sql) or die("Failed to query database".mysql_error());
     $row = mysqli_fetch_assoc($result);
     if($row)
     {
    
       header("location: homepage.php");
    }
    else
     {
       $_SESSION['status']= "Invalid Credentials";
       $_SESSION['status_code'] = "error";
     }
   }
?>
</body>
</html>
 <?php
include('includes/alert.php')
?> 
