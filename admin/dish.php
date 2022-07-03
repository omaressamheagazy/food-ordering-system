<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
    exit();
} else {
    include "init.php";

    $do =  isset($_GET["do"]) ? $_GET["do"] : "dish";
    $error = null;
    $success = null;
    if ($do == "dish") {
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
                <!-- End header header -->
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
                                        <h4 class="card-title">All Menu data</h4>
                                        <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>

                                        <div class="table-responsive m-t-40">
                                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Dish-Name</th>
                                                        <th>Slogan</th>
                                                        <th>Price</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Dish-Name</th>
                                                        <th>Slogan</th>
                                                        <th>Price</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM dishes order by d_id desc";
                                                    $query = mysqli_query($db, $sql);

                                                    if (!mysqli_num_rows($query) > 0) {
                                                        echo '<td colspan="11"><center>No Dish-Data!</center></td>';
                                                    } else {
                                                        while ($rows = mysqli_fetch_array($query)) {
                                                            $mql = "select * from restaurant where rs_id='" . $rows['rs_id'] . "'";
                                                            $newquery = mysqli_query($db, $mql);
                                                            $fetch = mysqli_fetch_array($newquery);

                                                            echo '<tr>' .  '
																					
																								<td>' . $rows['title'] . '</td>
																								<td>' . $rows['slogan'] . '</td>
																								<td>RM' . $rows['price'] . '</td>
																								<td><div class="col-md-3 col-lg-8 m-b-10">
																								<center><img src="Res_img/dishes/' . $rows['img'] . '" class="img-responsive  radius" style="max-height:100px;max-width:150px;" /></center>
																								</div></td>
                                                                                                <td><a href="dish.php?do=delete&menu_del=' . $rows['d_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                                                                <a href="dish.php?do=update&menu_upd=' . $rows['d_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
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
    } elseif ($do == "delete") {
        mysqli_query($db, "DELETE FROM dishes WHERE d_id = '" . $_GET['menu_del'] . "'");
        header("location:dish.php?");
    } else if ($do == "update") {
        if (isset($_POST['submit']))           //if upload btn is pressed
        {

            if (empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price'] == '' || $_POST['res_name'] == '') {
                $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>All fields Must be Fillup!</strong>
															</div>';
            } else {

                $fname = $_FILES['file']['name'];
                $temp = $_FILES['file']['tmp_name'];
                $fsize = $_FILES['file']['size'];
                $extension = explode('.', $fname);
                $extension = strtolower(end($extension));
                $fnew = uniqid() . '.' . $extension;

                $store = "Res_img/dishes/" . basename($fnew);                      // the path to store the upload image

                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
                    if ($fsize >= 5000000) {


                        $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
                    } else {




                        $sql = "update dishes set rs_id='$_POST[res_name]',title='$_POST[d_name]',favourite='$_POST[popularDish]',slogan='$_POST[about]',price='$_POST[price]',img='$fnew' where d_id='$_GET[menu_upd]'";  // update the submited data ino the database :images
                        mysqli_query($db, $sql);
                        move_uploaded_file($temp, $store);

                        $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Record</strong>Updated.
															</div>';
                    }
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
                    <!-- navbar -->
                    <?php include "{$tpl}navbar.php" ?>
                    <!-- End header header -->
                    <?php include "{$tpl}sidebar.php" ?>
                    <!-- End Left Sidebar  -->
                    <!-- Page wrapper  -->
                    <div class="page-wrapper" style="height:1200px;">
                        <!-- Bread crumb -->
                        <div class="row page-titles">
                            <div class="col-md-5 align-self-center">
                                <h3 class="text-primary">Dashboard</h3>
                            </div>
                            <div class="col-md-7 align-self-center">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>
                        <!-- End Bread crumb -->
                        <!-- Container fluid  -->
                        <div class="container-fluid">
                            <!-- Start Page Content -->
                            <?php echo $error;
                            echo $success; ?>
                            <div class="col-lg-12">
                                <div class="card card-outline-primary">
                                    <div class="card-header">
                                        <h4 class="m-b-0 text-white">Add Menu to Restaurant</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action='' method='post' enctype="multipart/form-data">
                                            <div class="form-body">
                                                <?php $qml = "select * from dishes where d_id='$_GET[menu_upd]'";
                                                $rest = mysqli_query($db, $qml);
                                                $roww = mysqli_fetch_array($rest);
                                                ?>
                                                <hr>
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Dish Name</label>
                                                            <input type="text" name="d_name" value="<?php echo $roww['title']; ?>" class="form-control" placeholder="Morzirella">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">About</label>
                                                            <input type="text" name="about" value="<?php echo $roww['slogan']; ?>" class="form-control form-control-danger" placeholder="slogan">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">price </label>
                                                            <input type="text" name="price" value="<?php echo $roww['price']; ?>" class="form-control" placeholder="RM">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Image</label>
                                                            <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/row-->

                                                <!--/span-->
                                                <!--/row-->
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Select Category</label>
                                                            <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                                <option>--Select Category--</option>
                                                                <?php $ssql = "select * from restaurant";
                                                                $res = mysqli_query($db, $ssql);
                                                                while ($row = mysqli_fetch_array($res)) {
                                                                    echo ' <option value="' . $row['rs_id'] . '">' . $row['title'] . '</option>';;
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <br>
                                                        <br>
                                                        <input type="hidden" id="hiddenCheckbox" name="popularDish" value="no">
                                                        <input type="checkbox" id="checkbox" name="popularDish" value="yes">
                                                        <label for="checkbox">make it one of popular dishes</label>
                                                    </div>
                                                </div>
                                                <!--/row-->
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
                <!-- footer -->
            <?php include "{$tpl}footer.php";
        } elseif ($do == "add") {
            if (isset($_POST['submit']))           //if upload btn is pressed
            {
                if (empty($_POST['d_name']) || empty($_POST['about']) || $_POST['price'] == '' || $_POST['res_name'] == '') {
                    $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>All fields Must be Fillup!</strong>
															</div>';
                } else {

                    $fname = $_FILES['file']['name'];
                    $temp = $_FILES['file']['tmp_name'];
                    $fsize = $_FILES['file']['size'];
                    $extension = explode('.', $fname);
                    $extension = strtolower(end($extension));
                    $fnew = uniqid() . '.' . $extension;

                    $store = "Res_img/dishes/" . basename($fnew);                      // the path to store the upload image

                    if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
                        if ($fsize >= 1000000) {
                            $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
                        } else {
                            $sql = "INSERT INTO dishes(rs_id,title,favourite,slogan,price,img) VALUE('" . $_POST['res_name'] . "','" . $_POST['d_name'] . "','" . $_POST['popularDish'] .  "','" . $_POST['about'] . "','" . $_POST['price'] . "','" . $fnew . "')";  // store the submited data ino the database :images
                            mysqli_query($db, $sql);
                            move_uploaded_file($temp, $store);

                            $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Congrass!</strong> New Dish Added Successfully.
															</div>';
                        }
                    } elseif ($extension == '') {
                        $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>select image</strong>
															</div>';
                    } else {

                        $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>invalid extension!</strong>png, jpg, Gif are accepted.
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


                                <?php echo $error;
                                echo $success; ?>
                                <div class="col-lg-12">
                                    <div class="card card-outline-primary">
                                        <div class="card-header">
                                            <h4 class="m-b-0 text-white">Add Dish to Menu</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action='' method='post' enctype="multipart/form-data" class="mainForm">
                                                <div class="form-body">

                                                    <hr>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Dish Name</label>
                                                                <input type="text" name="d_name" class="form-control" placeholder="Morzirella">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">About</label>
                                                                <input type="text" name="about" class="form-control form-control-danger" placeholder="slogan">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">price </label>
                                                                <input type="text" name="price" class="form-control" placeholder="RM">
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Image</label>
                                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <!--/row-->
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Category</label>
                                                                <select name="res_name" class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1">
                                                                    <option>--Select Category--</option>
                                                                    <?php $ssql = "select * from restaurant";
                                                                    $res = mysqli_query($db, $ssql);
                                                                    while ($row = mysqli_fetch_array($res)) {
                                                                        echo ' <option value="' . $row['rs_id'] . '">' . $row['title'] . '</option>';;
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <br>
                                                            <br>
                                                            <input type="hidden" id="hiddenCheckbox" name="popularDish" value="no">
                                                            <input type="checkbox" id="checkbox" name="popularDish" value="yes">
                                                            <label for="checkbox">make it one of popular dishes</label>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
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
    }
            ?>