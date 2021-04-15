<?php
								
									$db = mysqli_connect("localhost", "root", "", "products");
									$username = $_COOKIE["user"];
								
									$name_searched = $_GET['name_searched'];
									
									$name = $_GET['name'];
									$price = $_GET['price'];
									$condition = $_GET['condition'];
									$category = $_GET['category'];
									$description = $_GET['description'];
									$ok = $_GET['ok'];
									$image = $_GET['image'];
									$contact = $_GET['contact'];
									
									
									
									if($ok == 0)
									{
										$sql = "UPDATE prod SET Name = '$name', Price = '$price', Details = '$description', Cond = '$condition', Category = '$category', Contact = '$contact'  Where Name = '$name_searched'";	
										$res =  mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());	
									}
									else
									{
										$image_name = $_GET['image_name'];
										$image_size = $_GET['image_size'];
										$image_tmp_name = $_GET['image_tmp_name'];
										$image_error = $_GET['image_error'];
										$image_type = $_GET['image_type'];
										
										$target = "products/".basename($image_name);
										
										move_uploaded_file($image_tmp_name, $target);

										$db = mysqli_connect("localhost", "root", "", "products");
										$sql = "UPDATE prod SET Name = '$name', Price = '$price', Details = '$description', Cond = '$condition', Image = '$image_name', Category = '$category', Contact = '$contact'  Where Name = '$name_searched'";
										$res =  mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());			
									}	
?>