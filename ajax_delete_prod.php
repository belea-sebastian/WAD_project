<?php
                                
								$db = mysqli_connect("localhost","root","","products") or die("Unable to connect");

								$name = $_COOKIE["prod_name"];
							    $condition = $_COOKIE["prod_cond"];
							    $sql = "SELECT * FROM prod WHERE Name = '$name' AND Cond = '$condition'";
									
								$result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());
									
								$row = mysqli_fetch_assoc($result);
								if($row)
								{
										$sql = "DELETE FROM prod WHERE Name = '$name' AND Cond = '$condition'";
										$result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());
										echo "OK";
										return;
								}
								else
								{
									echo "NOK";
									return;
								}	

								// $sql = "DELETE FROM prod WHERE Name = '$name'";
								// $result = mysqli_query($db, $sql) or die("Failed to query database ".mysql_error());															
?>