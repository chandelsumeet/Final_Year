<?php
include_once("../../resources/config.php");
include("../../resources/template/back/header.php");
?>

<div id="page-wrapper">

    <div class="container-fluid">





        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">
                    All Orders

                </h1>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>

                        <tr>
                            <th>id</th>
                            <th>Amount</th>
                            <th>Transaction</th>
                            <th>Currency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php display_orders();  ?>


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