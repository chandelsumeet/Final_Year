<?php
include_once("../../resources/config.php");
include("../../resources/template/back/header.php");

?>

<?php

if(!isset($_SESSION['username']))
{
redirect("../index.php");
}


?>

<!-- <? echo $_SESSION['username'];

echo "hello world";

?> -->

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard <small> Statistics Overview

                    


                    </small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <?php

        if ($_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/") {
            include("../../resources/template/back/admin_content.php");
        }
        if (isset($_GET['orders'])) {
            include("orders.php");

        }


        ?>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php
include("../../resources/template/back/footer.php");
?>