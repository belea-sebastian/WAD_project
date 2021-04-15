<?php

include('language.php');

$connect = new PDO("mysql:host=localhost;dbname=products", "root", "");
if(!isset($_POST["minimum_range"], $_POST["maximum_range"]))
 {
   $minimum_range = 0;
   $maximum_range = 10000;
 }
 else {
 	$minimum_range = $_POST["minimum_range"];
    $maximum_range = $_POST["maximum_range"];
 }

 $query = "SELECT * FROM prod WHERE Price BETWEEN '".$minimum_range."' AND '".$maximum_range."' ";

 if(isset($_POST["category"]))
 {
 	
   array_walk($_POST["category"], function(&$item) { $item = "'".$item."'" ;}); 
   $category_filter = implode(",", $_POST["category"]);
  $query .= "
    AND Category IN($category_filter)
  ";
 }

 if(isset($_POST["condition"]))
 {
 	 array_walk($_POST["condition"], function(&$item) { $item = "'".$item."'" ;}); 
   $cond_filter = implode(",", $_POST["condition"]);
  $query .= "
    AND Cond IN($cond_filter)
  ";
 }
  
$lang = $_POST['lang'];

$query .= "
    ORDER BY Price ASC
  ";
$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '
<h4 align="center">'.$asd[$lang].' - '.$total_row.'</h4>
<div class="row">
';
if($total_row > 0)
{
	$prod_name = array();
                  $prod_price = array();
                  $prod_details = array();
                  $prod_cond = array();
                  $prod_image = array();
                  $prod_category = array();
                  $prod_contact = array();
                  $prod_poster = array();
                   $index = 0;
               

	foreach($result as $row)
	{
		array_push($prod_name,$row["Name"]);
                  array_push($prod_price,$row["Price"]);
                  array_push($prod_details,$row["Details"]);
                  array_push($prod_cond,$row["Cond"]);
                  array_push($prod_image,$row["Image"]); 
                  array_push($prod_category,$row["Category"]);
                  array_push($prod_contact,$row["Contact"]);
                  array_push($prod_poster,$row["Poster"]);
		$output .= '
		
               

              
                  
                   <div>
                      <button  class = "btn btn-dark" type="button" name = "contact" id = "contact" onclick = "my_function('.$index.')" >Contact</button>
                      <button style = "margin-left: 100px;" type="button" class="btn btn-danger" onclick="wishlist('.$index.')">
                        <span class="heart" aria-hidden="true"><i class="fas fa-heart"> '.$card[$lang][5].'</i></span>
                      </button>
                   </div>    
                   <div class="card">

                     <img class="card-img" src="products/'.$prod_image[$index].'" alt="Vans">

                     <div class="card-img-overlay d-flex justify-content-end">
                        <a href="#" class="card-link text-danger like"> </a>
                     </div>

                     <div class="card-body">
                        <h4 class="card-title" name = "name<?php echo $index ?>" id = "name'.$index.'"> '.$row["Name"] .'</h4>

                        <h6 class="card-subtitle mb-2 text-muted" name = "category'.$index.'" id = "category'.$index.'">'.$card[$lang][0].': '.$prod_category[$index].'</h6>
                        
                        <h6 class="card-text" name = "details<?php echo $index ?>" id = "details'.$index.'">'. $prod_details[$index].'</h6>
                    
                        <div class="price text-success">
                          <h5 class="mt-4" name = "price<?php echo $index ?>" id = "price'.$index.'">'.$card[$lang][1].': '.$prod_price[$index].' $</h5>
                        </div>

                        <div class="card-text se"> 
                          <h7 class="mt-4 font-weight-bold" name = "cond<?php echo $index ?>" id = "cond'.$index.'">'.$prod_cond[$index].'</h7>
                        </div>

                        <div class="card-text">
                          <h8 class="mt-4 text-info"> '.$card[$lang][2].': <span>'.$prod_poster[$index].'</span>  </h8>
                        </div>
                        <div class="card-text">
                          <h9 class="mt-4 text-info"> Contact: <span>'.$prod_contact[$index].'</span>  </h9>
                        </div>
                     </div>
                         <!-- End card -->
                   </div>
              
		';
		$index++;
	}
}
else
{
	$output .= '
	    <div style = "height: 350px; width:100%; position:relative;">         
	       <div style= " position: absolute; top: 50%; left: 50%;transform: translate(-50%, -50%);  display: block;
    font-size: 1.5em;
    margin-top: 0.67em;
    margin-bottom: 0.67em;
    font-weight: bold;">
	       No Product Found</div>
		</div>
	';
}

$output .= '
</div>
';

echo $output;

?>