<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
//error_reporting(0);
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
} else {
    include "init.php"
?>

    <body class="fix-header">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
        <!-- Main wrapper  -->
        <div id="main-wrapper">
            <?php include "{$tpl}navbar.php"; ?>
            <!-- Left Sidebar  -->
            <?php include "{$tpl}sidebar.php"; ?>
            <!-- End Left Sidebar  -->
            <!-- Page wrapper  -->
            <div class="page-wrapper" style="height:1200px;">
                <!-- Bread crumb -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-primary">Dashboard</h3>
                    </div>

                </div>
                <!-- End Bread crumb -->
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <!-- Start Page Content -->
                    <div class="row">

                        <div class="col-md-3">
                            <div class="card p-30">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h2><?php $sql = "select * from restaurant";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);

                                            echo $rws; ?></h2>
                                        <p class="m-b-0">Stores</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card p-30">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h2><?php $sql = "select * from dishes";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);

                                            echo $rws; ?></h2>
                                        <p class="m-b-0">Dishes</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card p-30">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-user f-s-40 color-danger"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h2><?php $sql = "select * from users";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);

                                            echo $rws; ?></h2>
                                        <p class="m-b-0">Customer</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card p-30">
                                <div class="media">
                                    <div class="media-left meida media-middle">
                                        <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="media-body media-text-right">
                                        <h2><?php $sql = "select * from users_orders";
                                            $result = mysqli_query($db, $sql);
                                            $rws = mysqli_num_rows($result);

                                            echo $rws; ?></h2>
                                        <p class="m-b-0">Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>














                    </div>
                    <!-- End PAge Content -->
                </div>
                <!-- End Container fluid  -->
                <!-- footer -->
                <footer class="footer"> © 2018 All rights reserved. </footer>
                <!-- End footer -->
            </div>
            <!-- End Page wrapper  -->
        </div>
        <!-- End Wrapper -->
        <!-- All Jquery -->
        <script src="js/lib/jquery/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="js/lib/bootstrap/js/popper.min.js"></script>
        <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="js/jquery.slimscroll.js"></script>
        <!--Menu sidebar -->
        <script src="js/sidebarmenu.js"></script>
        <!--stickey kit -->
        <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>

    </body>

</html>
<?php
}
?>