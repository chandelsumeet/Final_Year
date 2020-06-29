<?php

require_once("../../config.php");
global $conn;
if(isset($_GET['id']))
{

    $query = "DELETE  FROM orders WHERE order_id = " . mysqli_escape_string($conn,$_GET['id'])." ";
    $result = $conn->query($query);
    redirect("../../../public/admin/index.php?orders");
}
else
{
    redirect("../../../public/admin/index.php?orders");
}


?>