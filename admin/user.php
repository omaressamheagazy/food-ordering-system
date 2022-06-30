<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
session_start();
include "init.php";
$error = "";
$success = "";
$do =  isset($_GET["do"]) ? $_GET["do"] : "users";
if ($do == "users") {
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
                                    <h4 class="card-title">All Registered users</h4>

                                    <div class="table-responsive m-t-40">
                                        <table id="myTable" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>First-Name</th>
                                                    <th>Last-Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Reg-Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM users order by u_id desc";
                                                $query = mysqli_query($db, $sql);

                                                if (!mysqli_num_rows($query) > 0) {
                                                    echo '<td colspan="7"><center>No User-Data!</center></td>';
                                                } else {
                                                    while ($rows = mysqli_fetch_array($query)) {
                                                        echo ' <tr><td>' . $rows['username'] . '</td>
																								<td>' . $rows['f_name'] . '</td>
																								<td>' . $rows['l_name'] . '</td>
																								<td>' . $rows['email'] . '</td>
																								<td>' . $rows['phone'] . '</td>
																								<td>' . $rows['address'] . '</td>																								
																								<td>' . $rows['date'] . '</td>
																									<td><a href="user.php?do=delete&user_del=' . $rows['u_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									<a href="user.php?do=update&user_upd=' . $rows['u_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
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
        <?php include "{$tpl}footer.php";
    } else if ($do == "add") {

        if (isset($_POST["submit"])) {
            if (empty($_POST["Uname"]) || empty($_POST["Fname"]) || empty($_POST["email"]) || empty($_POST["password"])) {
        ?>
                <div>All fields are requiredS</div>
        <?php
            } else {
            $sql = "SELECT  username FROM admin WHERE username='{$_POST["Uname"]}' limit 1";
            $query = mysqli_query($db, $sql);
            // check if the entered username is used before in the database or not
            $isUserNameExist = mysqli_num_rows($query);
            if(!$isUserNameExist)  {
                $SQL = "insert into admin(FullName,username,password,email) values('" . $_POST["Fname"] . "','" . $_POST["Uname"] . "','" . $_POST["password"] . "','" . $_POST["email"]. "')";
                mysqli_query($db, $SQL);
                $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>succefully registered!</strong></div>';
            } else {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid username!</strong>
															</div>';
            }

            }
        }
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
                <!-- header header  -->
                <?php include "{$tpl}navbar.php" ?>
                <!-- End header header -->
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
                            <div class="container-fluid">
                                <!-- Start Page Content -->
                                <?php 
                                echo $error;
                                echo $success; ?>
                                <div class="col-lg-12">
                                    <div class="card card-outline-primary">
                                        <div class="card-header">
                                            <h4 class="m-b-0 text-white">Add Admin</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action='' method='post' enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <hr>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Username</label>
                                                                <input type="text" name="Uname" class="form-control" placeholder="username">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Full Name </label>
                                                                <input type="text" name="Fname" class="form-control" placeholder="doe">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Email</label>
                                                                <input type="text" name="email" class="form-control form-control-danger" placeholder="example@gmail.com">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Password</label>
                                                                <input type="text" name="password" class="form-control form-control-danger" placeholder="password">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Phone</label>
                                                                <input type="text" name="phone" class="form-control form-control-danger" placeholder="phone">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="submit" class="btn btn-success" value="save">
                                            <a href="dashboard.php" class="btn btn-inverse">Cancel</a>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End PAge Content -->
                    </div>
                    <!-- End Container fluid  -->
                <?php include "{$tpl}footer.php";
            } else if ($do == "delete") {
                mysqli_query($db, "DELETE FROM users WHERE u_id = '" . $_GET['user_del'] . "'");
                header("location:?do=users");
            } else if ($do == "update") {
                if (isset($_POST['submit'])) {
                    if (
                        empty($_POST['uname']) ||
                        empty($_POST['fname']) ||
                        empty($_POST['lname']) ||
                        empty($_POST['email']) ||
                        empty($_POST['password']) ||
                        empty($_POST['phone'])
                    ) {
                        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>All fields Required!</strong>
															</div>';
                    } else {
                        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
                        {
                            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid email!</strong>
															</div>';
                        } elseif (strlen($_POST['password']) < 6) {
                            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Password must be >=6!</strong>
															</div>';
                        } elseif (strlen($_POST['phone']) < 10) {
                            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid phone!</strong>
															</div>';
                        } else {
                            $mql = "update users set username='$_POST[uname]', f_name='$_POST[fname]', l_name='$_POST[lname]',email='$_POST[email]',phone='$_POST[phone]',password='" . md5($_POST["password"]) . "' where u_id='$_GET[user_upd]' ";
                            mysqli_query($db, $mql);
                            $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>User Updated!</strong></div>';
                        }
                    }
                }
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
                            <!-- header header  -->
                            <?php include "{$tpl}navbar.php" ?>
                            <!-- End header header -->
                            <!-- Left Sidebar  -->
                            <?php include "{$tpl}sidebar.php" ?>
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
                                        <div class="container-fluid">
                                            <!-- Start Page Content -->
                                            <?php
                                            echo $error;
                                            echo $success;
                                            echo var_dump($_POST);
                                            ?>
                                            <div class="col-lg-12">
                                                <div class="card card-outline-primary">
                                                    <div class="card-header">
                                                        <h4 class="m-b-0 text-white">Update Users</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php $ssql = "select * from users where u_id='$_GET[user_upd]'";
                                                        $res = mysqli_query($db, $ssql);
                                                        $newrow = mysqli_fetch_array($res); ?>
                                                        <form action='' method='postS'>
                                                            <div class="form-body">

                                                                <hr>
                                                                <div class="row p-t-20">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Username</label>
                                                                            <input type="text" name="uname" class="form-control" value="<?php echo $newrow['username']; ?>" placeholder="username">
                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group has-danger">
                                                                            <label class="control-label">First-Name</label>
                                                                            <input type="text" name="fname" class="form-control form-control-danger" value="<?php echo $newrow['f_name'];  ?>" placeholder="jon">
                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                </div>
                                                                <!--/row-->
                                                                <div class="row p-t-20">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Last-Name </label>
                                                                            <input type="text" name="lname" class="form-control" placeholder="doe" value="<?php echo $newrow['l_name']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                    <div class="col-md-6">
                                                                        <div class="form-group has-danger">
                                                                            <label class="control-label">Email</label>
                                                                            <input type="text" name="email" class="form-control form-control-danger" value="<?php echo $newrow['email'];  ?>" placeholder="example@gmail.com">
                                                                        </div>
                                                                    </div>
                                                                    <!--/span-->
                                                                </div>
                                                                <!--/row-->
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Password</label>
                                                                            <input type="text" name="password" class="form-control form-control-danger" value="<?php echo $newrow['password'];  ?>" placeholder="password">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="control-label">Phone</label>
                                                                            <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo $newrow['phone'];  ?>" placeholder="phone">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--/span-->
                                                                <!--/span-->
                                                            </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <input type="submit" name="submit" class="btn btn-success" value="save">
                                                        <a href="dashboard.php" class="btn btn-inverse">Cancel</a>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End PAge Content -->
                                </div>
                                <!-- End Container fluid  -->
                            <?php include "{$tpl}footer.php";
                        }
