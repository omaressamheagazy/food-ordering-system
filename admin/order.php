<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
    exit();
} else {
include "init.php";

$do =  isset($_GET["do"]) ? $_GET["do"] : "order";
if ($do == "order") {
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
                                                    <th>Dish Name</th>
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
                                                            <a href="order.php?do=delete&order_del=<?php echo $rows['o_id']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                    <?php
                                                        echo '<a href="order.php?do=edit&user_upd=' . $rows['o_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
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
    <?php
    include "{$tpl}footer.php";
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
                                                                <a href="?do=update&form_id=<?php echo $rows['o_id'] ?>" title="Update order">
                                                                    <button type="button" class="btn btn-primary">Take Action</button></a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Dish name:</strong></td>
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
    } elseif ($do == "delete") {
        mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '" . $_GET['order_del'] . "'");
        header("location:all_orders.php");
    } elseif ($do == "update") {
        if (isset($_POST['update'])) {
            $form_id = $_GET['form_id'];
            $status = $_POST['status'];
            $remark = $_POST['remark'];
            $query = mysqli_query($db, "insert into remark(frm_id,status,remark) values('$form_id','$status','$remark')");
            $sql = mysqli_query($db, "update users_orders set status='$status' where o_id='$form_id'");
            echo "<script>alert('form details updated successfully');</script>";
        }
        ?>

            <body>
                <?php include "{$tpl}navbar.php"; ?>
                <?php include "{$tpl}sidebar.php"; ?>
                <div style="margin-left:50px;">
                    <form name="updateticket" id="updatecomplaint" method="post">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><b>form Number</b></td>
                                <td><?php echo htmlentities($_GET['form_id']); ?></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>

                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td><select name="status" required="required">
                                        <option value="">Select Status</option>
                                        <option value="in process">In Process</option>
                                        <option value="closed">Closed</option>
                                        <option value="rejected">rejected</option>

                                    </select></td>
                            </tr>
                            <tr>
                                <td><b>Remark</b></td>
                                <td><textarea name="remark" cols="50" rows="10" required="required"></textarea></td>
                            </tr>
                            <tr>
                                <td><b>Action</b></td>
                                <td><input type="submit" name="update" class="btn btn-primary" value="Submit">
                                    <a href="?do=delete">
                                        <input class="cancelButton" name="Submit2" type="submit" class="btn btn-danger" value="Close this window " onClick="return f2();" style="cursor: pointer;" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </body>

</html>
<?php
    }
}
?>