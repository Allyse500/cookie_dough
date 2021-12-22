<?php
//if a post action was entered by the button named "searchButton"...
if(isset($_POST["searchButton"])){
    session_start();
    //declare variable of search term
    $searchInput = $_POST["searchInput"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //locate recipe----------------------------------------------------
    getPublicRecipes($connection, $searchInput);
}
else {
    header("location: ../index.php");//send user back to index.php if attempted to enter search.inc.php link without using submit btn
    exit();
}