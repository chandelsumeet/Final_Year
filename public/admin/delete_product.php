<?php

require_once("../../resources/config.php");
global $conn;
if(isset($_GET['id']))
{

    $query = "DELETE  FROM products WHERE product_id = " . mysqli_escape_string($conn,$_GET['id'])." ";
    $result = $conn->query($query);
    redirect("products.php");
}
else
{
    redirect("products.php");
}


?>