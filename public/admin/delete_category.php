<?php

require_once("../../resources/config.php");
global $conn;
if(isset($_GET['id']))
{

    $query = "DELETE  FROM categories WHERE cat_id = " . mysqli_escape_string($conn,$_GET['id'])." ";
    $result = $conn->query($query);
    redirect("categories.php");
}
else
{
    redirect("categories.php");
}


?>