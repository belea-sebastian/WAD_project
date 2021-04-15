<?php
  $connect = new PDO("mysql:host=localhost;dbname=products", "root", "");
  $user = $_POST["user"];
  $name = $_POST["name"];
  $condition = $_POST["condition"];

  $query = "SELECT * FROM wishlist WHERE user='$user' AND name = '$name' AND cond = '$condition'";
  $statement = $connect->prepare($query);
  $statement->execute();
  $result = $statement->fetchAll();
  

  $total_row = $statement->rowCount();

  if ($total_row > 0)
  {
  	echo 'Product is already in wishlist!';
  }
  else {
  	$db = mysqli_connect("localhost","root","","products") or die("Unable to connect");
  	$add_query = "INSERT INTO wishlist values('','$name','$condition', '$user') ";
  	$result2 = mysqli_query($db,$add_query) or die("Failed to query database".mysql_error());
    echo "Added to wishlist!";
  }
?>