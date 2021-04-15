<?php
   if(isset($_POST['submit_btn']))
   {
     $username = $_POST['username'];
     $password = $_POST['password'];

     $password = md5($password);
     $db = mysqli_connect("localhost","root","","accounts");
     $sql = "select * from users WHERE username = '$username' and password = '$password' ";

     $result = mysqli_query($db,$sql) or die("Failed to query database".mysql_error());

     $row = mysqli_fetch_assoc($result);
     if($row)
     {
       $_SESSION['username']= $username;
       $_SESSION['status'] = "Login success!";
       $_SESSION['status_code'] = "success";
       header("location: index.php");
     }
    else
     {
       $_SESSION['status']= "Ivalid Credentials";
       $_SESSION['status_code'] = "error";
     }
   }
?>
