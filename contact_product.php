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
   <link rel="stylesheet" type="text/css" href="css/contact_products.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="               sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
   <script src="ckeditor/ckeditor.js"></script>
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

     <?php
              $name_searched = $_COOKIE["contact_name"];
              $user = $_COOKIE["user"];
              
              $db = mysqli_connect("localhost", "root", "", "products");
              
              $sql = "select Name, Price, Details, Cond, Image, Category, Poster, Contact from prod where name = '$name_searched'";
                
              $result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());
         
              while($row = $result->fetch_assoc()) {
                 $prod_name = $row["Name"];
                 $prod_price = $row["Price"];
                 $prod_details = $row["Details"];
                 $prod_cond = $row["Cond"];
                 $prod_image = $row["Image"]; 
                 $prod_category = $row["Category"];
                 $prod_contact = $row["Contact"];
                 $prod_poster = $row["Poster"];
              }
              $db2 = mysqli_connect("localhost", "root", "", "accounts");
              $sql2 = "SELECT * FROM users WHERE username = '$prod_poster'";

              $result2 = mysqli_query($db2, $sql2) or die("Failed to query database ".mysql_error());
              
               while($row2 = $result2->fetch_assoc()) {
                $owner = $row2["email"];
               
              }

              $sql3 = "SELECT * FROM users WHERE username = '$user'";
              $result3 = mysqli_query($db2, $sql3) or die("Failed to query database ".mysql_error());
              
               while($row = $result3->fetch_assoc()) {
                $you = $row["email"];
               
              }

              mysqli_close($db);
              mysqli_close($db2);

              
    ?>

    <script>
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
              window.location.replace("shop.php");
          }
     function send_function()
     {
            var temp_prod_name = document.getElementById("name").value;
            var temp_prod_price = document.getElementById("price").value;
            var temp_prod_condition = document.getElementById("condition").value;
            var temp_prod_category = document.getElementById("category").value;
            var your_mentions = document.getElementById("mentions").value;
            var your_phone = document.getElementById("phone").value;
            var your_email = document.getElementById("your_email").value;
            var owner_email = document.getElementById("owner_email").value;

            var request = new XMLHttpRequest();
            

            request.open("GET", "ajax_contact_prod.php?name=" + temp_prod_name + "&price=" + temp_prod_price + "&condition=" + temp_prod_condition + "&category=" + temp_prod_category +  "&mentions=" + your_mentions + "&phone=" + your_phone + "&your_email=" + your_email + "&owner_email=" + owner_email, true);

            request.send();

            request.onreadystatechange = function() 
              {
                var aux = this.responseText;
                  alert(aux);
                if (this.readyState == 4 && this.status == 200) 
                {
                  var aux = this.responseText;
                  alert(aux);
                  if(aux == "OK")
                  {
                    alert("SEND");
                  }
                  else
                  {
                    alert(aux);
                  }
                }
              };

            window.close();
            
            

            //alert("Your mail was send!");
            window.location.replace("shop.php");
     }          
    </script>

<!-- action="shop.php" -->
    <div class="form">
       <form id = "as" method="POST" enctype="multipart/form-data " >

          <div class="modal-body">
            <div class="form-group w-100">
              <label style="font-size: 30px; display: block;">Product details</label>
              <label for="usr">Name:</label>
              <input name="name" type="text" class="form-control" id="name" value = <?php echo $prod_name ?> readonly>
              <label for="usr">Price:</label>
              <input name="price" type="text" class="form-control" id="price"  value = <?php echo $prod_price ?> readonly>
              <label for="usr">Contact:</label>
              <input name="contact" type="text" class="form-control" id="contact"  value = <?php echo $prod_contact ?> readonly>
              <label>Category:</label>
               <input name="category" type="text" class="form-control" id="category"  value = <?php echo $prod_category ?> readonly>
              <label for="comment">Details:</label>
              <textarea name="details" class="form-control" rows="5" id="details" readonly><?php echo $prod_details ?> </textarea>
              <script >
                CKEDITOR.replace('details');
              </script>
              <label>Condition:</label>
              <input name="condition" type="text" class="form-control" id="condition"  value = <?php echo $prod_cond ?> readonly>
            </div>
          </div>

       <form>

        <form id = "as" method="POST" enctype="multipart/form-data " >

          <div class="modal-body">
            <div class="form-group w-100">
              <label style="font-size: 30px; display: block;">Contact details</label>
              <label for="usr">Owner email:</label>
              <input name="owner_email" type="text" class="form-control" id="owner_email" value = <?php echo $owner ?> readonly>
              <label for="usr">Your email:</label> 
              <input name="your_email" type="text" class="form-control" id="your_email" value = <?php echo $you ?> >
              <label for="usr">Phone:</label>
              <br>
              <input type="tel" for="usr" id="phone" name="phone" placeholder="xxxx xxx xxx" pattern="[0-9]{4} [0-9]{3} [0-9]{3}" required>
              <br>
              <br>
              <label for="comment">Special mentions:</label>
              <textarea name="mentions" class="form-control" rows="5" id="mentions" ></textarea>
             </div>
          </div>

          <div class="modal-footer">
             <button name = "submit_btn" type="submit" class="btn btn-primary" onclick = "send_function()">Send</button>
          </div>

       <form>
    </div>

   <!--  second -->

    
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