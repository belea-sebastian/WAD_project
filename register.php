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
  <link rel="stylesheet" type="text/css" href="css/register.css">
  
</head>


<body>
   <div class="form-box">
      <img src="../images/user-icon.png">
      <h1>Sign Up</h1>

      <form action="register.php" method="POST" class="form-group">
         <i class="fas fa-user"></i>
         <input type="text" name = "username" class="input-field" placeholder="Username" required>
         <i class="fas fa-key"></i>
         <input type="password" name = "password" class="input-field" placeholder="Password" required>
         <input type="password" name = "re_password" class="input-field" placeholder="Confirm Password" required>
         <i class="fas fa-envelope-square"></i>
         <input type="email" name = "email" class="input-field" placeholder="Email" required>
         <input type="submit" name = "submit_btn" class="submit-btn" value="Sign Up">
         <input type="button" value="Home" class="submit-btn2" onclick="window.location='index.php';">
      </form>
   </div>
   <?php
   $db = mysqli_connect("localhost","root","","accounts") or die("Unable to connect");

   if(isset($_POST['submit_btn']))
   {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['re_password'];
    $email = $_POST['email'];
   
      if($password==$cpassword)
      {
         $query= "select * from users WHERE username='$username'";
         $result = mysqli_query($db,$query) or die("Failed to query database".mysql_error());
      
         if(mysqli_num_rows($result)>0)
         {
           // there is already a user with the same username
            $_SESSION['status']= "Username already exists!";
            $_SESSION['status_code'] = "error";
         }
         else
         {
            $password = md5($password);
            $query= "insert into users values('','$username','$password','$email')";
            $query_run = mysqli_query($db,$query);    
            if($query_run)
            {
              echo '<script type="text/javascript"> alert("User Registered.. Go to login page to login") </script>';
              header("location: login.php");
            }
            else
            {
              echo '<script type="text/javascript"> alert("'.mysqli_error($con).'") </script>';
              header("location: register.php");
            }
         }     
      }
      else
      {
         $_SESSION['status']= "Password and confirm password does not match!!";
         $_SESSION['status_code'] = "error"; 
      }
   }
?>
</body>

</html>

 <?php
include('includes/alert.php')
?> 