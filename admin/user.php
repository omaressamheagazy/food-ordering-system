<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
session_start();
include "init.php";

$do =  isset($_GET["do"]) ? $_GET["do"] : "order";
// if ($do == "order") {