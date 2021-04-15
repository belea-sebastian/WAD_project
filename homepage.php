<?php
  session_start();
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
   <link rel="stylesheet" type="text/css" href="css/homepage.css">
</head>
<body>
  <!-- Start Main Top -->
    <header >
        <!-- Start Navigation -->
        <nav class="nav-bar">
        	<div class="logo">
             <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt=""></a>
            </div>
           <ul  class="nav-items">
             <li ><a  href="homepage.php" class="link">Home</a></li>
             <li ><a  href="shop.php" class="link">Shop</a></li>
             <li ><a  href="about.php" class="link">About</a></li>
           </ul>
          <div class="current-user">
            <span>Welcome</span>
            <div class="cookie">
              <i class="fas fa-user"></i>
              <?php
               $username = $_COOKIE["user"];
               echo "<span>$username</span>";
              ?>    
            </div>  
          </div>

          <form class="myform" action="homepage.php" method="post">
              <input name="logout" type="submit" class="btn transparent" value="Log Out"/><br>
          </form>
          <?php
             if(isset($_POST['logout']))
             {
               session_destroy();
               header('location:index.php');
             }
          ?>
        </nav>
    </header>
   
    <div class="back"> 
      
    	<img src="images/ss.jpg" class="image">
      
    	<div class="headline">
          <h1 class="text1">Welcome</h1>
          <h2 class="text2">To</h2>
          <h3 class="text3">BikeHouse</h3>
          <h4 class="text4">Where you can find</h4>
          <h5 class="text5">multiple BIKE ads</h5>
        </div>
    </div>
   

    <div class="footer">
    	<div class="inner-footer">
    		<div class="logo-footer">
    			<img src="/images/logo.png">
    		</div>

    		<div class="footer-third">
    			<a href="https://support.google.com/?hl=en" target="_blank">Need help?</a>
    			<a href="https://www.termsandconditionsgenerator.com/live.php?token=CAtIiWkSRNhk8SabLDlLqDwcWG8keqTv" target="_blank">Terms &amp; Conditions</a>
    			<a href="https://www.privacypolicies.com/live/077a93e5-b9c9-4f30-9112-ac671145ba9b" target="_blank">Privacy Policy</a>
    		</div>

    		<div class="footer-third">
    			<h1>Follow us!</h1>
    			<li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook" style='font-size:36px'></i></a></li>
    			<li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram" style='font-size:36px'></i></a></li>
    			<li><a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter" style='font-size:36px'></i></a></li>
    		</div>
            
            <div class="footer-third">
            	<h2 class="none">A</h2>
            	<h2 class="none">A</h2>
    			<h2>Copyright &copy BicycleHouse, Inc.</h2>
    		</div>
    	</div>
    </div>
</body>
</html>