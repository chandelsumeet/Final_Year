<?php


function redirect($location)
{
    header("location: $location");
}

function get_product()
{
    global $conn;
    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        $product = <<<DELIMETER
        <div class="col-sm-4 col-lg-4 col-md-4">
        <div class="thumbnail">
          <a href="item.php?id={$row['product_id']}">  <img src="http://placehold.it/320x150" alt=""></a>
            <div class="caption">
                <h4 class="pull-right">{$row['product_price']}</h4>
                <h4><a href="category.php?id={$row['product_id']}">{$row['product_title']}</a>
                </h4>
                <p>{$row['short_desc']} <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add to cart</a>
            </div>
           
        </div>
    </div>
DELIMETER;
        echo $product;
    }
}


function get_products_in_cat_page()
{
    global $conn;

    $query = "SELECT * FROM products where product_category_id= " . mysqli_real_escape_string($conn, $_GET['id']) . "";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $product = <<<DELIMETER
        <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}</h3>
                <p>{$row['short_desc']}</p>
                <p>
                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>
DELIMETER;
        echo $product;
    }
}






function get_category()
{
    global $conn;

    $query = "SELECT * FROM categories";
    $result = $conn->query($query);

    if ($conn->error) {
        echo " error" . $conn->error;
    }

    while ($row = $result->fetch_assoc()) {
        $category_links = <<<DELIMETER
        <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
        echo $category_links;
    }
}


function login_user()
{
    global $conn;
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM users WHERE username = '{$username}' AND password='{$password}'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            redirect("../public/admin/index.php");
        } else {
            redirect("index.php");
        }
    }
}


function send_message()
{
    if (isset($_POST['submit'])) {
        $to = "sumeetchandel321@gmail.com";
        $subject = "Test mail";
        $message = "Hello! This is a simple email message.";
        $from = "sumeetchandel321@gmail.com";
        $headers = "From:" . $from;
        $result = mail($to, $subject, $message, $headers);


        echo $result;
    }
}





function get_products_in_shop_page()
{
    global $conn;

    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $product = <<<DELIMETER
        <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
            <img src="{$row['product_image']}" alt="">
            <div class="caption">
                <h3>{$row['product_title']}</h3>
                <p>{$row['short_desc']}</p>
                <p>
                    <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                </p>
            </div>
        </div>
    </div>
DELIMETER;
        echo $product;
    }
}


function display_orders()
{
    global $conn;
    $query = "SELECT * FROM orders";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {

        $orders = <<<DELIMETER
         <tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_amount']}</td>
            <td>{$row['order_transaction']}</td>
            <td>{$row['order_currency']}</td>
            <td>{$row['order_status']}</td>
            <td><a class="btn btn-danger" href ="../../resources/template/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove "</span></a>
         </tr>
DELIMETER;
        echo $orders;
    }
}


function get_products_in_admin()
{

    global $conn;
    $query = "SELECT * FROM products";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {

        $category = show_product_category_title($row['product_category_id']);

        $product = <<<DELIMETER
        <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']} <br>
          <a href="add_product.php?id={$row['product_id']}">  <img src="../../resources/uploads/{$row['product_image']}" alt=""></a>
            </td>
            <td>{$category}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td><a class="btn btn-danger" href ="../admin/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove "</span></a>

        </tr>
  
DELIMETER;
        echo $product;
    }
}


function add_product()
{
    global $conn;
    if (isset($_POST['publish'])) {

        $product_title = mysqli_escape_string($conn, $_POST['product_title']);
        $product_category_id = mysqli_escape_string($conn, $_POST['product_category_id']);
        $product_price = mysqli_escape_string($conn, $_POST['product_price']);
        $product_discription = mysqli_escape_string($conn, $_POST['product_discription']);
        $short_desc = mysqli_escape_string($conn, $_POST['short_desc']);
        $product_quantity = mysqli_escape_string($conn, $_POST['product_quantity']);
        $product_image = mysqli_escape_string($conn, $_FILES['file']['name']);
        $image_tmp_location = mysqli_escape_string($conn, $_FILES['file']['tmp_name']);

        move_uploaded_file($image_tmp_location, UPLOAD_DIRECTORY . DS . $product_image);

        $query = "INSERT INTO products (product_title,product_category_id,
        product_price,product_discription,short_desc,product_quantity,product_image)
        VALUES ('{$product_title}','{$product_category_id}',
        '{$product_price}','{$product_discription}','{$short_desc}','{$product_quantity}'
        ,'{$product_image}'
        )";

        $result = $conn->query($query);
        if ($conn->error) {
            echo $conn->error;
        }
        // redirect("../admin/delete_product.php");


    }
}

function get_category_at_category_page()
{
    global $conn;

    $query = "SELECT * FROM categories";
    $result = $conn->query($query);

    if ($conn->error) {
        echo " error" . $conn->error;
    }

    while ($row = $result->fetch_assoc()) {
        $category_links = <<<DELIMETER
        <option value="">{$row['cat_title']}</option>
DELIMETER;
        echo $category_links;
    }
}


function show_product_category_title($product_category_id)
{
    global $conn;
    $query = "SELECT * FROM categories WHERE cat_id = '{$product_category_id}'";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        return $row['cat_title'];
    }
}




function update_product()
{

    global $conn;

    if (isset($_POST['update'])) {


        $product_title          = mysqli_escape_string($conn, $_POST['product_title']);
        $product_category_id    = mysqli_escape_string($conn, $_POST['product_category_id']);
        $product_price          = mysqli_escape_string($conn, $_POST['product_price']);
        $product_description    = mysqli_escape_string($conn, $_POST['product_description']);
        $short_desc             = mysqli_escape_string($conn, $_POST['short_desc']);
        $product_quantity       = mysqli_escape_string($conn, $_POST['product_quantity']);
        $product_image          = mysqli_escape_string($conn, $_FILES['file']['name']);
        $image_temp_location    = mysqli_escape_string($conn, $_FILES['file']['tmp_name']);


        if (empty($product_image)) {

            $query = "SELECT product_image FROM products WHERE product_id =" . mysqli_escape_string($conn, $_GET['id']) . " ";
            $result = $conn->query($query);

            while ($row = $result->fetch_array($result)) {

                $product_image = $row['product_image'];
            }
        }



        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);


        $query = "UPDATE products SET ";
        $query .= "product_title            = '{$product_title}'        , ";
        $query .= "product_category_id      = '{$product_category_id}'  , ";
        $query .= "product_price            = '{$product_price}'        , ";
        $query .= "product_description      = '{$product_description}'  , ";
        $query .= "short_desc               = '{$short_desc}'           , ";
        $query .= "product_quantity         = '{$product_quantity}'     , ";
        $query .= "product_image            = '{$product_image}'          ";
        $query .= "WHERE product_id=" . mysqli_escape_string($conn, $_GET['id']);







        redirect("index.php?products");
    }
}


function show_categories()
{
    global $conn;
    $query = "SELECT * FROM categories";

    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $category = <<<DELIMETER
          <tr>
                <td>{$row['cat_id']}</td>
                <td>{$row['cat_title']}</td>
                <td><a class="btn btn-danger" href ="../admin/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-remove "</span></a></td>
          </tr>
          

DELIMETER;
        echo $category;
    }
}

function add_category()
{
    global $conn;
    if (isset($_POST['add_category'])) {
        
        $cat_title= $_POST['new_cat'];
        $query = "INSERT INTO categories (cat_title) VALUES ('{$cat_title}')";
        $result = $conn->query($query);
        
    }
}

function register_user()
{
    global $conn;
    if (isset($_POST['sign_up'])) {
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);

        $query = "INSERT INTO  users(username, password) VALUES ('{$username}','{$password}') ";
        $result = $conn->query($query);
        redirect("login.php");
    }
}