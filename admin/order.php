<?php 


$do =  isset($_GET["do"]) ? $_GET["do"] : "order";

if($do == "order") {
    echo "from order";
} elseif ($do == "delete") {
    echo "delete this";
} elseif ($d0 = "view") {
    echo "view";
}