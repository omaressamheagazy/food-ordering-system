<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
//error_reporting(0);
session_start();

include "init.php";
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
                                <h4 class="card-title">All user Orders</h4>

                                <div class="table-responsive m-t-40">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Title</th>
                                                <th>Quantity</th>
                                                <th>price</th>
                                                <th>Address</th>
                                                <th>status</th>
                                                <th>Reg-Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id ";
                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="8"><center>No Orders-Data!</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {

                                            ?>
                                                    <?php
                                                    echo ' <tr>
																					           <td>' . $rows['username'] . '</td>
																								<td>' . $rows['title'] . '</td>
																								<td>' . $rows['quantity'] . '</td>
																								<td>RM' . $rows['price'] . '</td>
																								<td>' . $rows['address'] . '</td>';
                                                    ?>
                                                    <?php
                                                    $status = $rows['status'];
                                                    if ($status == "" or $status == "NULL") {
                                                    ?>
                                                        <td> <button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars" aria-hidden="true">Dispatch</button></td>
                                                    <?php
                                                    }
                                                    if ($status == "in process") { ?>
                                                        <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>On a Way!</button></td>
                                                    <?php
                                                    }
                                                    if ($status == "closed") {
                                                    ?>
                                                        <td> <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($status == "rejected") {
                                                    ?>
                                                        <td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    echo '	<td>' . $rows['date'] . '</td>';
                                                    ?>
                                                    <td>
                                                        <a href="delete_orders.php?order_del=<?php echo $rows['o_id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                <?php
                                                    echo '<a href="view_order.php?user_upd=' . $rows['o_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
																									</td>
																									</tr>';
                                                }
                                            }


                                                ?>



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