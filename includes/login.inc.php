<?php
//if a post action was entered by the button named "loginSubmit"...
if(isset($_POST["loginSubmit"])){

    //make super global variables from submitted form data
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for log in------------------------------------------------
    if(emptyInputLogin($username, $pwd) !== false){
        header("location: ../index.php?error=emptyLoginInput");
        exit();
    }

    loginUser($connection, $username, $pwd);
}
else {
    header("location: ../index.php");
    exit();
}