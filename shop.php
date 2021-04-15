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
<?php
$minimum_range = 0;
$maximum_range = 10000;
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
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
             <li ><a  href="homepage.php" class="link">  <?php echo $top_nav[$language_1][0]; ?> </a></li>
             <li ><a  href="shop.php" class="link"><?php echo $top_nav[$language_1][1]; ?></a></li>
             <li ><a  href="about.php" class="link"><?php echo $top_nav[$language_1][2]; ?></a></li>
           </ul>
          <div class="current-user">
            <span ><?php echo $top_nav[$language_1][3]; ?></span>
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
              <option id = "1" value="<?php echo $language_1 ?>" ><?php echo $language_1 ?></option>
              <option id = "2" value="<?php echo $language_2 ?>"><?php echo $language_2 ?></option>
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

</script>
<!-- Modal -->
  <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $add_prod[$language_1][0]; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
        </div>

        <form action="shop.php" method="POST" enctype="multipart/form-data">

          <div class="modal-body">
            <div class="form-group">
              <label for="usr"><?php echo $add_prod[$language_1][1]; ?>:</label>
              <input name="name" type="text" class="form-control" id="usr" required>
              <label for="usr"><?php echo $add_prod[$language_1][2]; ?>:</label>
              <input name="price" type="text" class="form-control" id="usr" required>
              <label for="usr"><?php echo $add_prod[$language_1][3]; ?>:</label>
              <input name="contact" type="text" class="form-control" id="usr" required>
              <label><?php echo $add_prod[$language_1][4]; ?>:</label>
              <select name="category" class="form-control selectpicker" required>
                <option value=""><?php echo $add_prod[$language_1][5]; ?></option>
                <option value="Electric">Electric</option>
                <option value="City"><?php echo $add_prod[$language_1][6]; ?></option>
                <option value="MTB">MTB</option>
                <option value="BMX">BMX</option>
                <option value="Kids"><?php echo $add_prod[$language_1][7]; ?></option>
                <option value="Cyclocross">Cyclocross</option>
                <option value="Other"><?php echo $add_prod[$language_1][8]; ?></option>
              </select>
              <label for="comment"><?php echo $add_prod[$language_1][9]; ?>:</label>
              <textarea name="details" class="form-control" rows="5" id="comment" required></textarea>
              <script >
                CKEDITOR.replace('details');
              </script>
              <label><?php echo $add_prod[$language_1][10]; ?>:</label>
              <select name="condition" class="form-control selectpicker" required>
                <option value=""><?php echo $add_prod[$language_1][5]; ?></option>
                <option value="New"><?php echo $add_prod[$language_1][11]; ?></option>
                <option value="Second Hand">Second Hand</option>
              </select>
              <label for="exampleFormControlFile1"><?php echo $add_prod[$language_1][12]; ?></label>
              <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1" required> 
            </div>
          </div>

          <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $add_prod[$language_1][13]; ?></button>
             <button name = "submit_btn" type="submit" class="btn btn-primary"><?php echo $add_prod[$language_1][14]; ?></button>
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

    function my_function(index){
       var prod_name = document.getElementById("name" + index).innerHTML;
       setCookie("contact_name", prod_name, "1");
       alert(prod_name);
        window.location.replace("contact_product.php"); 
       // window.location.replace("test.php"); 
    } 
    
    function set_language(){
       var language = jQuery('#language').val();
       setCookie("language", language, "1");
       window.location.replace("shop.php");
    }

   </script>

   <div style="position: absolute; top: 500px;">
 <div class="col-md-2">   
      <div class="list-group">
                   <h3>Category</h3>
                    <div style="height: 100px; width: 200px;">
     <?php
                   $connect = new PDO("mysql:host=localhost;dbname=products", "root", "");


                    $query = "SELECT DISTINCT(Category) FROM prod";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector category" value="<?php echo $row['Category']; ?>"  > <?php echo $row['Category']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
            </div>
            <div class="col-md-2">   
      <div class="list-group">
                   <h3 style="margin-top: 150px;"><?php echo $add_prod[$language_1][10]; ?></h3>

                    <div style="height: 100px; width: 200px;">
     
                      <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector condition" value="New"> New</label>
                        
                      </div>
                       <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector condition" value="Second Hand"> Second Hand</label>
                        
                      </div>
                    </div>
                </div>
            </div>
       </div> 
     
     <div class="body-title">
         <h1 ><?php echo $title[$language_1]; ?></h1>
     </div>
     <button type="button" id="addButton" class="btn btn-dark" >
             <?php echo $buttons[$language_1][0]; ?>
     </button> 
     <button type="button" id="myButton"  class="btn btn-dark" onClick="window.location='products.php';">  <?php echo $buttons[$language_1][1]; ?></button>
     <button type="button" id="myButton"  class="btn btn-dark" onClick="window.location='wishlist.php';">  <?php echo $buttons[$language_1][5]; ?></button>
          
     <h4 style = "text-align: right;"><input type="text" name="search" id = "search" placeholder=<?php echo $buttons[$language_1][3]; ?>>
         <button class = "btn btn-dark" type="button" name = "search_button" id = "search_button" onclick = "searh_function()" > <?php echo $buttons[$language_1][2]; ?></button>
     </h4>

     <div class="container" style="margin-left: 10px; left: 200px;">  

         <h3 style="margin-left: 300px;"><?php echo $title3[$language_1]; ?></a></h3><br />
         <br>
         <div class="row" style="margin-left: 100px;">
            <div class="col-md-2">
               <input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
            </div>
            <div class="col-md-5" style="padding-top:12px">
                <div id="price_range"></div>
            </div>
            <div class="col-md-2">
               <input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
            </div>
         </div>
         <br>
         <br>
         <br>
         <div class="row" style="margin-left: 200px;">
            <div class="col-8 col-sm-4 col-md-5" id="xx"> </div>
         </div>
         <br />
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

<script>
function wishlist(index){
   var user = getCookie("user");
   var name = document.getElementById("name" + index).innerHTML;
   var condition = document.getElementById("cond" + index).innerHTML;
   $.ajax({
      url:"add_wishlist.php",
      method:"POST",
      data:{user:user, name:name,condition:condition},
      success:function(data)
      {
        // $('#xx').fadeIn('slow').html(data);
        alert(data);
      }
    });

}
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}

function my_function(index){
        var prod_name = document.getElementById("name" + index).innerHTML;
        setCookie("contact_name", prod_name, "1");
      
        window.location.replace("contact_product.php"); 
       // window.location.replace("test.php"); 
    } 
$(document).ready(function(){  
    
  $( "#price_range" ).slider({
    range: true,
    min: 0,
    max: 10000,
    values: [ <?php echo $minimum_range; ?>, <?php echo $maximum_range; ?> ],
    slide:function(event, ui){
      $("#minimum_range").val(ui.values[0]);
      $("#maximum_range").val(ui.values[1]);
       load_product(ui.values[0], ui.values[1]);
    }
  });
  
  load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>);
  
  function load_product(minimum_range, maximum_range)
  {
    var category = get_filter('category');
    var condition = get_filter('condition');
    var lang = document.getElementById("1").innerHTML;
    $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{minimum_range:minimum_range, maximum_range:maximum_range, category:category,condition:condition, lang:lang},
      success:function(data)
      {
        $('#xx').fadeIn('slow').html(data);
      }
    });
  }
  
  function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

     $('.common_selector').click(function(){
        load_product();
    });
  
});  
</script>

 <script type="text/javascript">
 
 $("#addButton").click(function(){
     $(document).ready(function(){

         $("#AddModal").modal('show');
         
    });

     $('#AddModal').on('hide', function() {
          window.location.reload();
});
   
});
  </script>

<?php
include('includes/alert.php')
?> 

