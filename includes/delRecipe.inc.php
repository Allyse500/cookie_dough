<?php

//if a post action was entered by the button named "drcDelBtn"...
if(isset($_POST["drcDelBtn"])){

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current user
    $user = $_SESSION["userId"];
    $title = $_SESSION["recipeName"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    deleteRecipe($connection, $user, $title);

}

//send user back to user.php if attempted to enter newRecipe.inc.php link without using submit btn
else{
header("location: ../user.php");//return user to user page
exit();
}