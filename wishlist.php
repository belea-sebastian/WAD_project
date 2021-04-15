<?php
  session_start();
?>
<?php
   require_once('database.php');

  $database = new CreateDB();
?>
<?php
  include('language.php');

  $en_select = '';
  $ro_select = '';
  $language_1 = '';
  $language_2 = '';
  if((isset($_COOKIE['language']) && $_COOKIE['language'] =='EN') || !isset($_COOKIE['language']) )
  {
    $en_select = 'selected';
    $language_1 = 'EN';
    $language_2 = 'RO';
  }
  else {
    $ro_select = 'selected';
    $language_1 = 'RO';
    $language_2 = 'EN';
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
   <link rel="stylesheet" type="text/css" href="css/products.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="               sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <script src="js/sweetalert.min.js"></script>
   <script src="ckeditor/ckeditor.js"></script>
   <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

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
             <li ><a  href="homepage.php" class="link"><?php echo $top_nav[$language_1][0]; ?></a></li>
             <li ><a  href="shop.php" class="link"><?php echo $top_nav[$language_1][1]; ?></a></li>
             <li ><a  href="about.php" class="link"><?php echo $top_nav[$language_1][2]; ?></a></li>
           </ul>
          <div class="current-user">
            <span><?php echo $top_nav[$language_1][3]; ?></span>
            <div class="cookie">
              <i class="fas fa-user"></i>
              <?php
               $username = $_COOKIE["user"];
               echo "<span>$username</span>";
              ?>    
            </div>  
          </div>
           <li>
            <?php echo $top_nav[$language_1][4]; ?>
          <select style="margin-left: 10px;" onchange="set_language()" name="language" id="language">
              <option value="<?php echo $language_1 ?>" ><?php echo $language_1 ?></option>
              <option value="<?php echo $language_2 ?>"><?php echo $language_2 ?></option>
          </select>
          </li> 
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

    <div class="body-content">
      <div class="body-title">
        <h1 ><?php echo $wishlist[$language_1][0]; ?>:</h1>
      </div>
      
        <script>
           function set_language(){
              var language = jQuery('#language').val();
              setCookie("language", language, "1");
              window.location.replace("wishlist.php");
           }

          function delete_function(index)
            {
              var result = confirm("Want to delete?");
               if (result) {
                  var name = document.getElementById("name" + index).innerHTML;
                  var cond = document.getElementById("cond" + index).innerHTML;

                  $.ajax({
                   url:"remove_wishlist.php",
                   method:"POST",
                   data:{name:name,cond:cond},
                   success:function(data)
                   {
                      alert(data);
                      location.replace("wishlist.php");
                    }
                   });
                }
            } 

          function setCookie(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
        </script>

        <div class="container">
           <div class="row">
             <div class="col-8 col-sm-4 col-md-5 ">
              <?php
                $db = mysqli_connect("localhost","root","","products") or die("Unable to connect");
                $user = $_COOKIE["user"];
                
                $ch = "SELECT * FROM wishlist WHERE user = '$user'";
                $ch_res = mysqli_query($db,$ch) or die("Failed to query database".mysql_error());
                if ( mysqli_num_rows($ch_res) == 0 ) {
                  echo '<div style = "height: 200px; width:100%; position:relative;">         
         <div style= " position: absolute; top: 50%; left: 50%;transform: translate(-50%, -50%);  display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    font-weight: bold;">
         No Product Found</div>
    </div>';

                }
              
              else
              {
                  $prod_name = array();
                  $prod_price = array();
                  $prod_details = array();
                  $prod_cond = array();
                  $prod_image = array();
                  $prod_category = array();
                  $prod_contact = array();
                  $names = array();
                  $conds = array();

                $db = mysqli_connect("localhost","root","","products") or die("Unable to connect");
                
                $q = "SELECT name,cond FROM wishlist";
                $res = mysqli_query($db,$q) or die("Failed to query database".mysql_error());
                while($r = mysqli_fetch_assoc($res) )
                {
                  $name = str_replace(' ', '',$r['name']);
                  array_push($names,$name);

                  $cond = str_replace(' ', '',$r['cond']);
                  array_push($conds,$cond);
                }
                array_walk($names, function(&$item) { $item = "'".$item."'" ;}); 
                $name_filter = implode(",", $names);

                array_walk($conds, function(&$item) { $item = "'".$item."'" ;}); 
                $cond_filter = implode(",", $conds);

                  $query = "SELECT * FROM prod WHERE prod.Name IN ($name_filter) AND prod.Cond IN ($cond_filter)";

                  $result = mysqli_query($db,$query) or die("Failed to query database".mysql_error());

                   while ($row = mysqli_fetch_assoc($result))
                  {
                  array_push($prod_name,$row["Name"]);
                  array_push($prod_price,$row["Price"]);
                  array_push($prod_details,$row["Details"]);
                  array_push($prod_cond,$row["Cond"]);
                  array_push($prod_image,$row["Image"]); 
                  array_push($prod_category,$row["Category"]);
                  array_push($prod_contact,$row["Contact"]);
                }
                 
                  ?>  
                  <?php for ($index = 0;  $index < count($prod_name); $index++) { ?>
                   <div class="card">

                     <img class="card-img" src="products/<?php echo $prod_image[$index]?>" alt="Vans">

                     <div class="card-img-overlay d-flex justify-content-end">
                        <a href="#" class="card-link text-danger like"> </a>
                     </div>

                     <div class="card-body">
                        <h4 class="card-title" name = "name<?php echo $index ?>" id = "name<?php echo $index ?>"> <?php echo $prod_name[$index] ?></h4>

                        <h6 class="card-subtitle mb-2 text-muted" name = "category<?php echo $index ?>" id = "category<?php echo $index ?>"><?php echo $card[$language_1][0]; ?>: <?php echo $prod_category[$index]?></h6>
                        
                        <h6 class="card-text" name = "details<?php echo $index ?>" id = "details<?php echo $index ?>"><?php echo $prod_details[$index]?></h6>
                    
                        <div class="price text-success">
                          <h5 class="mt-4" name = "price<?php echo $index ?>" id = "price<?php echo $index ?>"><?php echo $card[$language_1][1]; ?>: <?php echo $prod_price[$index]?> $</h5>
                        </div>

                        <div class="card-text se"> 
                          <h7 class="mt-4 font-weight-bold" name = "cond<?php echo $index ?>" id = "cond<?php echo $index ?>"><?php echo $prod_cond[$index]?></h7>
                        </div>

                        <div class="card-text">
                          <h8 class="mt-4 text-info"> <?php echo $card[$language_1][2]; ?>: <?php echo "<span> $username</span>" ?> </h8>
                        </div>
                        <div class="card-text">
                          <h9 class="mt-4 text-info"> Contact: <?php echo "<span>$prod_contact[$index]</span>" ?> </h9>
                        </div>
                     </div>
                         <!-- End card -->
                   </div>    
                    <button type="submit" class = "btn btn-danger" id = "edit-card" onclick="delete_function(<?php echo $index ?>)"> <?php echo $card[$language_1][4]; ?> </button>
                 
               <?php         
                }
              }   
            ?>
              </div>
            </div>
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