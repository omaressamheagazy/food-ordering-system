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
                                <h4 class="card-title">All stores data</h4>
                                <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                <div class="table-responsive m-t-40">
                                    <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Cat</th>
                                                <th>Store-Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Url</th>
                                                <th>Open Hrs</th>
                                                <th>Close Hrs</th>
                                                <th>Open Days</th>
                                                <th>Address</th>
                                                <th>Store-Image</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Cat</th>
                                                <th>Store-Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Url</th>

                                                <th>Open Hrs</th>
                                                <th>Close Hrs</th>
                                                <th>Open Days</th>
                                                <th>Address</th>
                                                <th>Store-Image</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>


                                            <?php
                                            $sql = "SELECT * FROM restaurant order by rs_id desc";
                                            $query = mysqli_query($db, $sql);

                                            if (!mysqli_num_rows($query) > 0) {
                                                echo '<td colspan="11"><center>No Srores-Data!</center></td>';
                                            } else {
                                                while ($rows = mysqli_fetch_array($query)) {

                                                    $mql = "SELECT * FROM res_category where c_id='" . $rows['c_id'] . "'";
                                                    $res = mysqli_query($db, $mql);
                                                    $row = mysqli_fetch_array($res);

                                                    echo ' <tr><td>' . $row['c_name'] . '</td>
																								<td>' . $rows['title'] . '</td>
																								<td>' . $rows['email'] . '</td>
																								<td>' . $rows['phone'] . '</td>
																								<td>' . $rows['url'] . '</td>
																								
																								
																								<td>' . $rows['o_hr'] . '</td>
																								<td>' . $rows['c_hr'] . '</td>
																								<td>' . $rows['o_days'] . '</td>
																								
																								<td>' . $rows['address'] . '</td>
																								
																								<td><div class="col-md-3 col-lg-8 m-b-10">
																								<center><img src="Res_img/' . $rows['image'] . '" class="img-responsive radius"  style="min-width:150px;min-height:100px;"/></center>
																								</div></td>
																								
																								<td>' . $rows['date'] . '</td>
																									 <td><a href="delete_stores.php?res_del=' . $rows['rs_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_restraunt.php?res_upd=' . $rows['rs_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
																									</td></tr>';
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


    <script src="js/lib/datatables/datatables.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/lib/datatables/datatables-init.js"></script>
</body>

</html>