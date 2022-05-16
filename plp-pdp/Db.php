<?php
try {
  $connection = mysqli_connect("localhost", "user123", "password@123", "products");
}    
catch(Exception $e)
{
    echo $e->getMessage();
}

?>