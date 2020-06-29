<?php include_once("../resources/config.php");

include_once("../resources/template/front/header.php");

?>


    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Register User <?php  register_user() ?></h1>
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="form-group"><label for="">
                    username<input type="text" name="user" class="form-control"></label>
                </div>
               
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="pass" class="form-control"></label>
                </div>

                <div class="form-group">
                <a href="login.php" class="btn btn-info">Login</a>
                  <input type="submit" name="sign_up" class="btn btn-info" value="Sign up">
                </div>
            </form>

            
        </div>  


    </header>


        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2030</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
