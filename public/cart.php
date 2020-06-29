<?php require_once("../resources/config.php");

?>

<?php



if (isset($_GET['add'])) {
    global $conn;
    $query = "SELECT * FROM products WHERE product_id=" . mysqli_real_escape_string($conn, $_GET['add']) . "";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            $_SESSION['product_' . $_GET['add']] += 1;
            redirect("checkout.php");
        } else {
            redirect("checkout.php");
        }
    }
}


if (isset($_GET['remove'])) {

    $_SESSION['product_' . $_GET['remove']]--;
    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        redirect("checkout.php");
    } else {
        redirect("checkout.php");
    }
}

if (isset($_GET['delete'])) {
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['item_quantity']) ;
    unset($_SESSION['item_total']) ;
    redirect("checkout.php");
}


function cart()
{
    $total = 0;
    $item_quantity = 0;



    foreach ($_SESSION as $name => $value) {

        if ($value > 0) {

            if (substr($name, 0, 8) == "product_") {

                $length = strlen($name);
                $id = substr($name, 8, $length);

                global $conn;
                $query = "SELECT * FROM products WHERE product_id = " . mysqli_real_escape_string($conn, $id) . " ";
                $result = $conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    $sub = $row['product_price'] * $value;
                    $item_quantity += $value;
                    $product = <<<DELIMETER
                    <tr>
                            <td>{$row['product_title']}</td>
                            <td>{$row['product_price']}</td>
                            <td>{$value}</td>
                            <td>{$sub}</td>
                            <td>
                            <a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class = "glyphicon glyphicon-minus"></span></a>
                            <a  class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class ="glyphicon glyphicon-plus"> </span></a>
                            <a  class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class ="glyphicon glyphicon-remove"> </span></a>
                            </td>
                    </tr>
                    
DELIMETER;
                    echo $product;




                   
                    $_SESSION['item_total'] =  $total += $sub;
                    $_SESSION['item_quantity'] = $item_quantity;
                    
                  
                }
            }
        }
    }
}



?>