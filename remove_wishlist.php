<?php
  $connect = new PDO("mysql:host=localhost;dbname=products", "root", "");
  $name = $_POST["name"];
  $cond = $_POST["cond"];
  $user = $_COOKIE["user"];

  $query = "DELETE FROM wishlist WHERE user='$user' AND name = '$name' AND cond = '$cond'";
  $statement = $connect->prepare($query);
  $statement->execute();
  
  echo "Product was deleted";
?>