<?php
  session_start();
?>
<?php
   require_once('database.php');

  $database = new CreateDB();
?>
<?php
 $searched_prod = $_COOKIE["search"];
 if(empty($searched_prod))
 {
   header('location: shop.php');
   exit();
  }
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
   <link rel="stylesheet" type="text/css" href="css/shop.css">
   <script src="js/jquery-1.10.2js"></script>
   <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="               sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <script src="ckeditor/ckeditor.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <link rel="stylesheet"
    href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
               if(isset($_COOKIE["user"])):
               setcookie("user", "", time() - 3600, '/');
               endif;
               session_destroy();
               header('location:index.php');
             }
           ?>
        </nav>
    </header>
    <!-- Button trigger modal -->

</script>
<!-- Modal -->
  <div class="modal fade" id="productAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add product details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
        </div>

        <form action="shop.php" method="POST" enctype="multipart/form-data">

          <div class="modal-body">
            <div class="form-group">
              <label for="usr">Name:</label>
              <input name="name" type="text" class="form-control" id="usr" required>
              <label for="usr">Price:</label>
              <input name="price" type="text" class="form-control" id="usr" required>
              <label for="usr">Contact:</label>
              <input name="contact" type="text" class="form-control" id="usr" required>
              <label>Category:</label>
              <select name="category" class="form-control selectpicker" required>
                <option value="">Select</option>
                <option value="Electric">Electric</option>
                <option value="City">City</option>
                <option value="MTB">MTB</option>
                <option value="BMX">BMX</option>
                <option value="Kids">Kids</option>
                <option value="Cyclocross">Cyclocross</option>
                <option value="Other">Other</option>
              </select>
              <label for="comment">Details:</label>
              <textarea name="details" class="form-control" rows="5" id="comment" required></textarea>
              <script >
                CKEDITOR.replace('details');
              </script>
              <label>Condition:</label>
              <select name="condition" class="form-control selectpicker" required>
                <option value="">Select</option>
                <option value="New">New</option>
                <option value="Second Hand">Second Hand</option>
              </select>
              <label for="exampleFormControlFile1">Choose an image</label>
              <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" required> 
            </div>
          </div>

          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button name = "submit_btn" type="submit" class="btn btn-primary">Submit</button>
          </div>

       <form>

      </div>
    </div>
   </div>
   
   <script >
     function searh_function()
            {
              var prod_name = document.getElementById("search").value;
              setCookie("search", prod_name, "1");
              var request = new XMLHttpRequest();

              
              request.open("GET", "ajax_search_request.php", true);
              request.send();
              
              request.onreadystatechange = function() 
              {
                if (this.readyState == 4 && this.status == 200) 
                {
                  window.location.replace("searched_prod.php");
                }
              };
              window.location.replace("searched_prod.php");
            }

    function setCookie(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }      
   </script>

   <div class="body-content">
         <div class="body-title">
           <h1 >Bike House Products</h1>
         </div>
         <button type="button" id="addButton" class="btn btn-dark" data-toggle="modal" data-target="#productAddModal">
              Add product
          </button> 
          <button type="button" id="myButton"  class="btn btn-dark" onClick="window.location='products.php';"> My products</button>
          <h4 style = "text-align: right;"><input type="text" name="search" id = "search" placeholder="Search by name">
            <button class = "btn btn-dark" type="button" name = "search_button" id = "search_button" onclick = "searh_function()" >Search</button>
          </h4>
          

      <div class="container">
           <div class="row">
             <div class="col-8 col-sm-4 col-md-5 ">
              <?php


                  $db = mysqli_connect("localhost", "root", "", "products");
              
                  $sql = "SELECT * FROM prod";
                  $result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());

                  $prod_name = array();
                  $prod_price = array();
                  $prod_details = array();
                  $prod_cond = array();
                  $prod_image = array();
                  $prod_category = array();
                  $prod_contact = array();
 
                 while($row = $result->fetch_assoc()) {
                     if(strpos(strtolower($row["Name"]), strtolower($searched_prod)) !== false)
                    {
                       array_push($prod_name,$row["Name"]);
                       array_push($prod_price,$row["Price"]);
                       array_push($prod_details,$row["Details"]);
                       array_push($prod_cond,$row["Cond"]);
                       array_push($prod_image,$row["Image"]); 
                       array_push($prod_category,$row["Category"]);
                       array_push($prod_contact,$row["Contact"]);  
                   }                  
                
                }
             
                  mysqli_close($db);
              
                ?>  
                   <?php for ($index = 0;  $index < count($prod_name); $index++) { ?>
                   <div class="card">

                     <img class="card-img" src="products/<?php echo $prod_image[$index]?>" alt="Vans">

                     <div class="card-img-overlay d-flex justify-content-end">
                        <a href="#" class="card-link text-danger like"> </a>
                     </div>

                     <div class="card-body">
                        <h4 class="card-title" name = "name<?php echo $index ?>" id = "name<?php echo $index ?>"> <?php echo $prod_name[$index] ?></h4>

                        <h6 class="card-subtitle mb-2 text-muted" name = "category<?php echo $index ?>" id = "category<?php echo $index ?>">Category: <?php echo $prod_category[$index]?></h6>
                        
                        <h6 class="card-text" name = "details<?php echo $index ?>" id = "details<?php echo $index ?>"><?php echo $prod_details[$index]?></h6>
                    
                        <div class="price text-success">
                          <h5 class="mt-4" name = "price<?php echo $index ?>" id = "price<?php echo $index ?>">Price: <?php echo $prod_price[$index]?> $</h5>
                        </div>

                        <div class="card-text se"> 
                          <h7 class="mt-4 font-weight-bold" name = "cond<?php echo $index ?>" id = "cond<?php echo $index ?>"><?php echo $prod_cond[$index]?></h7>
                        </div>

                        <div class="card-text">
                          <h8 class="mt-4 text-info"> Posted by: <?php echo "<span> $username</span>" ?> </h8>
                        </div>
                        <div class="card-text">
                          <h9 class="mt-4 text-info"> Contact: <?php echo "<span>$prod_contact[$index]</span>" ?> </h9>
                        </div>
                     </div>
                         <!-- End card -->
                   </div>    
                   <?php }  ?>

              </div>
              </div>
            </div>
        </div>
   <!--  </div>
   </div> --> <!-- body-content -->
      
  

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  
  <?php
     $db = mysqli_connect("localhost","root","","products") or die("Unable to connect");
     
     if (isset($_POST['submit_btn']))
     {
       $name = $_POST['name'];
       $price = $_POST['price'];
       $details = $_POST['details'];
       $condition = $_POST['condition'];
       $image = $_FILES['image']['name'];
       $category = $_POST['category'];
       $contact = $_POST['contact'];
       $poster = $username;

       if (!is_numeric($price))
       {
         $_SESSION['status']= "Invalid input, only decimal point values allowed.";
         $_SESSION['status_code'] = "error";
       }

       $target = "products/".basename($_FILES['image']['name']);

       $verify = "select * from prod WHERE name='$name'";
       $result = mysqli_query($db,$verify) or die("Failed to query database".mysql_error());
       

        if(mysqli_num_rows($result)>0)
        {
           // there is already a product with the same name
            $_SESSION['status']= "Product already exists!";
            $_SESSION['status_code'] = "error";    
        }
        else
        {
          $query= "INSERT INTO prod values('','$name','$price','$details','$condition','$image','$category','$poster','$contact')";
          $query_run = mysqli_query($db,$query);

          if($query_run)
         {
          $_SESSION['status']= "Product added.";
          $_SESSION['status_code'] = "success";
         }

         if (move_uploaded_file($_FILES['image']['tmp_name'], $target))
          {
             $msg = "Image uploaded successfully";
          }
          else
          {
           $msg = "Failed to upload image";
          }    
        }

     }
  ?>
</body>
</html>
<?php
include('includes/alert.php')
?> 

