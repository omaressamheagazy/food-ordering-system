<!DOCTYPE html>
<html lang="en">
<?php
include "init.php";
$error = null;
$success = null;
// error_reporting(0);
session_start();
?>



<body>
    <!--header starts-->
    <?php include "{$tpl}navbar.php" ?>
    <!-- /.navbar -->
    </header>
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay online</a></li>
                </ul>
            </div>
        </div>
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
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <?php $ress = mysqli_query($db, "select * from category");
                                while ($rows = mysqli_fetch_array($ress)) {
                                ?>

                                    <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                        <div class="entry-logo">
                                            <a class="img-fluid" href="dishes.php?res_id=<?php echo $rows['id'] ?>"> <img src="admin/Res_img/<?php echo $rows['image'] ?>" alt="Food logo"></a>
                                        </div>
                                        <!-- end:Logo -->
                                        <div class="entry-dscr">
                                            <h5><a href="dishes.php?res_id=<?php echo $rows['id'] ?>"><?php echo $rows['title'] ?></a></h5> <span>
                                        </div>
                                        <!-- end:Entry description -->
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                        <div class="right-content bg-white">
                                            <div class="right-review">
                                            <br>
                                                <a href="dishes.php?res_id=<?php echo $rows['id'] ?>" class="btn theme-btn-dash">View <?php echo $rows['title'] ?></a>
                                            </div>
                                        </div>
                                        <!-- end:right info -->
                                    </div>
                                <?php
                                }
                                ?>

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
                    <a href="#"> Nasi </a> <span>Order Delivery &amp; Take-Out </span>
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
    <!-- end:Footer -->
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>