<?php
// make all the routes here
include("connection/connect.php");  //include connection file
$css = "layout/css copy/";
$js = "layout/js/";
$tpl = "template/";
$func = "includes/functions/";




// include all the important files
if(!isset($noNavBar)) {
    include "{$tpl}navbar.php";
}

if (!isset($noHeader)) {
    include "{$func}function.php";
    include "{$tpl}header.php";
}
