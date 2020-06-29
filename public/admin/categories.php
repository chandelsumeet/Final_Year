
<?php
include_once("../../resources/config.php");
include("../../resources/template/back/header.php");

?>

        <div id="page-wrapper">

            <div class="container-fluid">

            

            

<h1 class="page-header">
  Product Categories

</h1>


<div class="col-md-4">
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title  <?php add_category(); ?></label>
            <input type="text" class="form-control" name="new_cat">
        </div>

        <div class="form-group">
   
                <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
 <?php   show_categories() ?>
    </tbody>

        </table>

</div>



                













            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
