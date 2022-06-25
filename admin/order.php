<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
session_start();
include "init.php";
include "{$tpl}header.php";

$do =  isset($_GET["do"]) ? $_GET["do"] : "order";

if ($do == "order") {
    echo "from order";
} elseif ($do == "edit") {
?>

    <body class="fix-header fix-sidebar">
        <!-- Preloader - style you can find in spinners.css -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
        <!-- Main wrapper  -->
        <div id="main-wrapper">
            <!-- header header  -->
            <?php include "{$tpl}navbar.php" ?>
            <!-- Left Sidebar  -->
            <?php include "{$tpl}sidebar.php"; ?>
            <!-- End Left Sidebar  -->
            <!-- Page wrapper  -->
            <div class="page-wrapper">
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View user Orders</h4>

                                    <div class="table-responsive m-t-20">
                                        <table id="myTable" class="table table-bordered table-striped">

                                            <tbody>
                                                <?php
                                                $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id where o_id='" . $_GET['user_upd'] . "'";
                                                $query = mysqli_query($db, $sql);
                                                $rows = mysqli_fetch_array($query);
                                                ?>
                                                <tr>
                                                    <td><strong>username:</strong></td>
                                                    <td>
                                                        <center><?php echo $rows['username']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="javascript:void(0);" onClick="popUpWindow('order_update.php?form_id=<?php echo htmlentities($rows['o_id']); ?>');" title="Update order">
                                                                <button type="button" class="btn btn-primary">Take Action</button></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Title:</strong></td>
                                                    <td>
                                                        <center><?php echo $rows['title']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?newform_id=<?php echo htmlentities($rows['o_id']); ?>');" title="Update order">
                                                                <button type="button" class="btn btn-primary">View User Detials</button></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Quantity:</strong></td>
                                                    <td>
                                                        <center><?php echo $rows['quantity']; ?></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Price:</strong></td>
                                                    <td>
                                                        <center>RM<?php echo $rows['price']; ?></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Address:</strong></td>
                                                    <td>
                                                        <center><?php echo $rows['address']; ?></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Date:</strong></td>
                                                    <td>
                                                        <center><?php echo $rows['date']; ?></center>
                                                    </td>
                                                <tr>
                                                    <td><strong>status:</strong></td>
                                                    <?php
                                                    $status = $rows['status'];
                                                    if ($status == "" or $status == "NULL") {
                                                    ?>
                                                        <td>
                                                            <center><button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars" aria-hidden="true">Dispatch</button></center>
                                                        </td>
                                                    <?php
                                                    }
                                                    if ($status == "in process") { ?>
                                                        <td>
                                                            <center><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>On a Way!</button></center>
                                                        </td>
                                                    <?php
                                                    }
                                                    if ($status == "closed") {
                                                    ?>
                                                        <td>
                                                            <center><button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button></center>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($status == "rejected") {
                                                    ?>
                                                        <td>
                                                            <center><button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button> </center>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
        <!-- footer -->
        <?php include "{$tpl}footer.php" ?>
        <!-- end footer -->
    <?php

    echo "delete this";
} elseif ($d0 = "view") {
    echo "view";
}
    ?>