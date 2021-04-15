
<?php
  function component($name,$price,$details,$cond,$image,$category,$username,$index)
  {
  	$element = "
             <div class=\"card\">
                   <img class=\"card-img\" src=\"products/$image\" alt=\"Vans\">
                  <div class=\"card-img-overlay d-flex justify-content-end\">
                     <a href=\"#\" class=\"card-link text-danger like\"> </a>
                  </div>
                  <div class=\"card-body\">
                    <h4 class=\"card-title\" name = \"name<?php echo $index ?>\" id = \"name<?php echo $index ?>\"> $name</h4>
                    <h6 class=\"card-subtitle mb-2 text-muted\">Category: $category</h6>
                    <p class=\"card-text\"> $details </p>
                    
                    <div class=\"price text-success\">
                       <h5 class=\"mt-4\">Price: $price</h5>
                    </div>
                    <div class=\"card-text se\"> 
                         <h7 class=\"mt-4 font-weight-bold\">$cond</h7>
                    </div>
                    
                     <div class=\"card-text\"> 
                      <h8 class=\"mt-4 text-info\">Posted by:<?php echo \"<span> $username</span>\" </h8>
                    </div>
                   
                 </div>
            </div>
  	";

  	echo $element;
      
  }
?>