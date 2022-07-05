<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION["adm_id"])) {
    header('location:index.php');
    exit();
} else {
    $pageTitle = "Category";
    include "init.php";

    $do =  isset($_GET["do"]) ? $_GET["do"] : "category";
    $error = null;
    $success = null;
    if ($do == "category") {
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
                                                        <th>Category</th>
                                                        <th>Category-Name</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Category-Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM category order by id desc";
                                                    $query = mysqli_query($db, $sql);

                                                    if (!mysqli_num_rows($query) > 0) {
                                                        echo '<td colspan="11"><center>No Srores-Data!</center></td>';
                                                    } else {
                                                        while ($rows = mysqli_fetch_array($query)) {

                                                            $mql = "SELECT * FROM category where id='" . $rows['id'] . "'";
                                                            $res = mysqli_query($db, $mql);
                                                            $row = mysqli_fetch_array($res);
                                                    ?>
                                                            <tr>
                                                                <td> <?php echo $rows['title'] ?> </td>
                                                                <td>
                                                                    <div class="col-md-2 col-lg-3 m-b-10">
                                                                        <center><img src="Res_img/<?php echo $rows['image'] ?>" class="img-responsive radius" style="min-width:150px;min-height:100px;" /></center>
                                                                    </div>
                                                                </td>
                                                                <td><a href="?do=delete&res_del= <?php echo $rows['id'] ?>" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                                    <a href="?do=update&res_upd=<?php echo $rows['id'] ?>" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
                                                                </td>
                                                            </tr>
                                                    <?php
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
        if (isset($_POST['submit']))           //if upload btn is pressed
        {
            if (empty($_POST['res_name'])) {
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

                $store = "Res_img/" . basename($fnew);                      // the path to store the upload image

                if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
                    if ($fsize >= 1000000) {


                        $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
                    } else {


                        $res_name = $_POST['res_name'];

                        $sql = "INSERT INTO category(title, image) VALUE('" . $res_name . "','" . $fnew . "')";  // store the submited data ino the database :images
                        mysqli_query($db, $sql);
                        move_uploaded_file($temp, $store);

                        $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Congrass!</strong> New category Added Successfully.
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
                    <?php include "{$tpl}navbar.php"; ?>
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
                            <?php echo $error;
                            echo $success; ?>
                            <div class="col-lg-12">
                                <div class="card card-outline-primary">
                                    <div class="card-header">
                                        <h4 class="m-b-0 text-white">Add Category</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action='' method='post' enctype="multipart/form-data">
                                            <div class="form-body">
                                                <hr>
                                                <div class="row p-t-20">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Category Name</label>
                                                            <input type="text" name="res_name" class="form-control" placeholder="John doe">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">Image</label>
                                                            <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                <!-- footer -->
            <?php include "{$tpl}footer.php";
        } else if ($do == "update") {
            if (isset($_POST['submit']))           //if upload btn is pressed
            {
                if (empty($_POST['res_name'])) {
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

                    $store = "Res_img/" . basename($fnew);                      // the path to store the upload image

                    if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
                        if ($fsize >= 1000000) {


                            $error =     '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Max Image Size is 1024kb!</strong> Try different Image.
															</div>';
                        } else {


                            $res_name = $_POST['res_name'];

                            $sql = "update category set  title='$res_name',image='$fnew' where id='$_GET[res_upd]' ";  // store the submited data ino the database :images												mysqli_query($db, $sql); 
                            mysqli_query($db, $sql);
                            move_uploaded_file($temp, $store);

                            $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Record Updated!</strong>.
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
                        <?php include "{$tpl}navbar.php" ?>
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

                                        <h4 class="m-b-0 ">Update category</h4>

                                        <div class="card-body">
                                            <form action='' method='post' enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <?php $ssql = "select * from category where id='$_GET[res_upd]'";
                                                    $res = mysqli_query($db, $ssql);
                                                    $row = mysqli_fetch_array($res); ?>
                                                    <hr>
                                                    <div class="row p-t-20">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Category Name</label>
                                                                <input type="text" name="res_name" value="<?php echo $row['title'];  ?>" class="form-control" placeholder="John doe">
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Image</label>
                                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                                                            </div>
                                                        </div>
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
                        <!-- footer -->
                        <!-- End footer -->
                <?php include "{$tpl}footer.php";
            } else if ($do == "delete") {
                mysqli_query($db, "DELETE FROM category WHERE id = '" . $_GET['res_del'] . "'");
                header("location:?do=category");
            }
        }
                ?>