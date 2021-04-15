<?php

//fetch_data.php



if(isset($_POST["action"]))
{
 $query = " SELECT * FROM prod";

 if(isset($_POST["category"]))
 {
  $brand_filter = implode("','", $_POST["category"]);
  $query .= "
   AND Category IN('".$brand_filter."')
  ";
 }
 }
  $db = mysqli_connect("localhost", "root", "", "products");
  $result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());
while($row = $result->fetch_assoc()) {
   $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
     <img src="products/'. $row['Image'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['Name'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-danger" >'. $row['Price'] .'</h4>
     <p>Camera : '. $row['Details'].' MP<br />
     Brand : '. $row['Cond'] .' <br />
     RAM : '. $row['Category'] .' GB<br />
     Storage : '. $row['Poster'] .' GB </p>
    </div>

   </div>
   ';
  }
 
 echo $output;
}

?>