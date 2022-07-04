<?php

include("../connection/connect.php");  //include connection file
// make all the routes here
    $tpl = "template/";
    $css = "layout/css/";
    $js = "layout/js/";
    $func = "includes/functions/";

// include all the important files
include "{$func}function.php";
if(!isset($noHeader)) {
    include "{$tpl}header.php";
} else {
    include "{$tpl}altHeader.php";
}
