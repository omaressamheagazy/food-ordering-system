<!DOCTYPE html>
<html lang="en">
<?php
//error_reporting(0);
$pageTitle = "Order";
include "init.php";
session_start();

if (empty($_SESSION['user_id']))  //if usser is not login redirected baack to login page
{
    header('location:login5.php');
    exit();
} else {
?>


        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.html"> Kak Su Naksi Kerabu </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="menu.php">Menu <span class="sr-only"></span></a> </li>

                            <?php
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login5.php" class="nav-link active">login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">signup</a> </li>';
                            } else {


                                echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">your orders</a> </li>';
                                echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">logout</a> </li>';
                            }

                            ?>

                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->

            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">


                    </div>
                </div>
            </div>
            <!-- //results show -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">


                            <div class="widget clearfix">
                                <!-- /widget heading -->
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                        Popular tags
                                    </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget-body">
                                    <ul class="tags">
                                        <li> <a href="#" class="tag">
                                                Pizza
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Sendwich
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Sendwich
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Fish
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Desert
                                            </a> </li>
                                        <li> <a href="#" class="tag">
                                                Salad
                                            </a> </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end:Widget -->
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 ">
                            <div class="bg-gray restaurant-entry">
                                <div class="row">

                                    <table>
                                        <thead>
                                            <tr>

                                                <th>Item</th>
                                                <th>Quantity</th>
                                                <th>price</th>
                                                <th>status</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            // displaying current session user login orders 
                                            $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                                            if (!mysqli_num_rows($query_res) > 0) {
                                                echo '<td colspan="6"><center>You have No orders Placed yet. </center></td>';
                                            } else {

                                                while ($row = mysqli_fetch_array($query_res)) {

                                            ?>
                                                    <tr>
                                                        <td data-column="Item"> <?php echo $row['title']; ?></td>
                                                        <td data-column="Quantity"> <?php echo $row['quantity']; ?></td>
                                                        <td data-column="price">RM<?php echo $row['price']; ?></td>
                                                        <td data-column="status">
                                                            <?php
                                                            $status = $row['status'];
                                                            if ($status == "" or $status == "NULL") {
                                                            ?>
                                                                <button type="button" class="btn btn-info" style="font-weight:bold;">Dispatch</button>
                                                            <?php
                                                            }
                                                            if ($status == "in process") { ?>
                                                                <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>On a Way!</button>
                                                            <?php
                                                            }
                                                            if ($status == "closed") {
                                                            ?>
                                                                <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true">Delivered</button>
                                                            <?php
                                                            }
                                                            ?>
                                                            <?php
                                                            if ($status == "rejected") {
                                                            ?>
                                                                <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i>cancelled</button>
                                                            <?php
                                                            }
                                                            ?>






                                                        </td>
                                                        <td data-column="Date"> <?php echo $row['date']; ?></td>
                                                        <td data-column="Action"> <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                                        </td>

                                                    </tr>


                                            <?php }
                                            } ?>




                                        </tbody>
                                    </table>



                                </div>
                                <!--end:row -->
                            </div>



                        </div>



                    </div>
                </div>
        </div>
        </section>
        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">
                <!-- top footer statrs -->
                <div class="row top-footer">
                    <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                        <a href="#"> Kak Su Naksi Kerabu </a> <span>Order Delivery &amp; Take-Out </span>
                    </div>
                    <div class="col-xs-12 col-sm-2 about color-gray">
                        <h5>About Us</h5>
                        <ul>
                            <li><a href="#">About us</a> </li>
                            <li><a href="#">History</a> </li>
                            <li><a href="#">Our Team</a> </li>
                            <li><a href="#">We are hiring</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                        <h5>How it Works</h5>
                        <ul>
                            <li><a href="#">Enter your location</a> </li>
                            <li><a href="#">Choose restaurant</a> </li>
                            <li><a href="#">Choose meal</a> </li>
                            <li><a href="#">Pay via credit card</a> </li>
                            <li><a href="#">Wait for delivery</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-2 pages color-gray">
                        <h5>Pages</h5>
                        <ul>
                            <li><a href="#">Search results page</a> </li>
                            <li><a href="#">User Sing Up Page</a> </li>
                            <li><a href="#">Pricing page</a> </li>
                            <li><a href="#">Make order</a> </li>
                            <li><a href="#">Add to cart</a> </li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                        <h5>Popular locations</h5>
                        <ul>
                            <li><a href="#">Sarajevo</a> </li>
                            <li><a href="#">Split</a> </li>
                            <li><a href="#">Tuzla</a> </li>
                            <li><a href="#">Sibenik</a> </li>
                            <li><a href="#">Zagreb</a> </li>
                            <li><a href="#">Brcko</a> </li>
                            <li><a href="#">Beograd</a> </li>
                            <li><a href="#">New York</a> </li>
                            <li><a href="#">Gradacac</a> </li>
                            <li><a href="#">Los Angeles</a> </li>
                        </ul>
                    </div>
                </div>
                <!-- top footer ends -->
                <!-- bottom footer statrs -->
                <div class="row bottom-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 payment-options color-gray">
                                <h5>Payment Options</h5>
                                <ul>
                                    <li>
                                        <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                    </li>
                                    <li>
                                        <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-4 address color-gray">
                                <h5>Address</h5>
                                <p>Concept design of oline food order and deliveye,planned as restaurant directory</p>
                                <h5>Phone: <a href="tel:+080000012222">080 000012 222</a></h5>
                            </div>
                            <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                <h5>Addition informations</h5>
                                <p>Join the thousands of other restaurants who benefit from having their menus on TakeOff</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bottom footer ends -->
            </div>
        </footer>
<?php
        include "{$tpl}footer.php";
}
?>