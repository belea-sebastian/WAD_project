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
			  echo '<script type="text/javascript"> alert("Username already exists") </script>';
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
			echo '<script type="text/javascript"> alert("Password and confirm password does not match!") </script>';	
		}
   }
?>