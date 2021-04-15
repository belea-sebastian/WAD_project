<?php
     $db = mysqli_connect("localhost","root","","products") or die("Unable to connect");
     
     if (isset($_POST['submit_btn']))
     {
       $name = $_POST['name'];
       $price = $_POST['price'];
       $details = $_POST['details'];
       $condition = $_POST['condition'];
       $image = $_FILES['image']['name'];
       echo("$condition");
       if (!is_float(floatval($price)))
       {
        echo("$price");
         $_SESSION['status']= "Invalid input, only decimal point values allowed.";
         $_SESSION['status_code'] = "error";
       }

       //$target = "products/".basename($_FILES['image']['name']);

       $query= "INSERT INTO prod values('','$name','$price','$details','$condition','$image')";
       $query_run = mysqli_query($db,$query);
       echo("ASD");
       if($query_run)
       {
        echo("ADDED");
         //$_SESSION['status']= "Product added.";
         //$_SESSION['status_code'] = "success";
       }    
     }
  ?>
  <?php
include('includes/alert.php')
?> 