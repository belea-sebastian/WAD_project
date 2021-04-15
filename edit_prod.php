<?php
  session_start();
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
   <link rel="stylesheet" type="text/css" href="css/edit_prod.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="               sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
    <?php
             if(isset($_POST["back"]))
             {
                header('location: products.php');
             }
           ?>
     <?php
              $name_searched = $_COOKIE["name_searched"];
              
              $db = mysqli_connect("localhost", "root", "", "products");
              
              $sql = "select Name, Price, Details, Cond, Image, Category, Contact from prod where name = '$name_searched'";
                
              $result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());
         
              while($row = $result->fetch_assoc()) {
                 $prod_name = $row["Name"];
                 $prod_price = $row["Price"];
                 $prod_details = $row["Details"];
                 $prod_cond = $row["Cond"];
                 $prod_image = $row["Image"]; 
                 $prod_category = $row["Category"];
                 $prod_contact = $row["Contact"];
              }
              mysqli_close($db);
    ?>
    
    <script>
    function set_language(){
              var language = jQuery('#language').val();
              setCookie("language", language, "1");
              window.location.replace("edit_prod.php");
           }
    function setCookie(cname, cvalue, exdays) {
              var d = new Date();
              d.setTime(d.getTime() + (exdays*24*60*60*1000));
              var expires = "expires="+ d.toUTCString();
              document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }
          
   function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {

               var c = ca[i];

               while (c.charAt(0) == ' ') {
                 c = c.substring(1);
               }

               if (c.indexOf(name) == 0) {
                 return c.substring(name.length, c.length);
               }

            }
       return "";
    }

     function edit_function()
          {
            var temp_prod_name = document.getElementById("name").value;
            var temp_prod_price = document.getElementById("price").value;
            var temp_prod_condition = document.getElementById("condition").value;
            var temp_prod_category = document.getElementById("category").value;
            var temp_name_search = getCookie("name_searched");
            var temp_prod_contact = document.getElementById("contact").value;
            var temp_prod_description = escape(CKEDITOR.instances.details.getData());
            var ok;
            
           

            if(document.getElementById("image").value == "")
            {
              ok = 0;
              var temp_prod_image_name = "empty";
              var temp_prod_image_size = "0";
              var temp_prod_image_type = "empty";
              var temp_prod_image_tmp_name = "empty";
              var temp_prod_image_error = "0";
            }
            else
            {
              ok = 1;
             
              var temp_prod_image_name = document.getElementById("image").files[0].name;
              var temp_prod_image_size = document.getElementById("image").files[0].size;
              var temp_prod_image_type = document.getElementById("image").files[0].type;
              var temp_prod_image_tmp_name = document.getElementById("image").files[0].tmp_name;
              var temp_prod_image_error = "0";

            }

            var request = new XMLHttpRequest();
            

             request.open("GET", "ajax_edit_prod.php?name=" + temp_prod_name + "&name_searched=" + temp_name_search +  "&price=" + temp_prod_price + "&condition=" + temp_prod_condition + "&category=" + temp_prod_category + "&ok=" + ok + "&image_name=" + temp_prod_image_name + "&image_size=" + temp_prod_image_size + "&image_type=" + temp_prod_image_type + "&image_error=" + temp_prod_image_error + "&image_tmp_name=" + temp_prod_image_tmp_name + "&description= " + temp_prod_description + "&contact=" + temp_prod_contact, true);

              request.send();
              window.close();
              
              alert("Product was edited!!!");
             
          }     
    </script>

<!-- action="shop.php" -->





    <div class="form">
       <form id = "as" method="POST" enctype="multipart/form-data " >

          <div class="modal-body">
            <div class="form-group w-100">
              <label for="usr"><?php echo $edit[$language_1][0]; ?>:</label>
              <input name="name" type="text" class="form-control" id="name" value = <?php echo $prod_name ?> >
              <label for="usr"><?php echo $edit[$language_1][1]; ?>:</label>
              <input name="price" type="text" class="form-control" id="price"  value = <?php echo $prod_price ?> >
              <label for="usr">Contact:</label>
              <input name="contact" type="text" class="form-control" id="contact"  value = <?php echo $prod_contact ?> >
              <label><?php echo $edit[$language_1][2]; ?>:</label>
              <select name="category" class="form-control selectpicker"  id="category">
                <option value = <?php echo $prod_category ?> > <?php echo $prod_category ?> </option>
                <option value="Electric">Electric</option>
                <option value="City">City</option>
                <option value="MTB">MTB</option>
                <option value="BMX">BMX</option>
                <option value="Kids">Kids</option>
                <option value="Cyclocross">Cyclocross</option>
                <option value="Other">Other</option>
              </select>
              <label for="comment"><?php echo $edit[$language_1][4]; ?>:</label>
              <textarea name="details" class="form-control" rows="5" id="details" ><?php echo $prod_details ?></textarea>
              <script >
                CKEDITOR.replace('details');
              </script>
              <label><?php echo $edit[$language_1][5]; ?>:</label>
              <select name="condition" class="form-control selectpicker" id="condition">
                <option value = <?php echo $prod_cond ?> > <?php echo $prod_cond ?> </option>
                <option value="New">New</option>
                <option value="Second Hand">Second Hand</option>
              </select>
              <label for="exampleFormControlFile1"><?php echo $edit[$language_1][6]; ?></label>
              <br>
              <label> <?php echo $edit[$language_1][7]; ?>: <?php echo $prod_image?></label>
              <input name="image" id="image" type="file" class="form-control-file"> 
            </div>
          </div>

          <div class="modal-footer">
            <button class="btn btn-dark" name="back" type="submit"><?php echo $edit[$language_1][9]; ?></button>
             <button name = "submit_btn" type="submit" class="btn btn-primary" onclick = "edit_function()"><?php echo $edit[$language_1][8]; ?></button>
          </div>
       <form>
    </div>
        <!-------- end form ----------------->

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
  
</body>
</html>
<?php
include('includes/alert.php')
?> 