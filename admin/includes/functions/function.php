<?php
function getPageTitle() {
    global $pageTitle;
    $pageTitle = isset($pageTitle) ? $pageTitle : "Default";
    echo $pageTitle;
}