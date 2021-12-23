<?php
//if a post action was entered by the button named "deleteAcctBtn"...
if(isset($_POST["deleteAcctBtn"])){

    //make super global variables from submitted form data
    $pwd = $_POST["deleteAcctuserPW"];

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current email
    $currentEmail = $_SESSION["email"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for delete acct------------------------------------------------
    if(emptyInputDeleteAcct($pwd) !== false){
        header("location: ../user.php?error=emptyInput");
        exit();
    }
    deleteAcct($connection, $pwd, $currentEmail);
}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter deleteAcct.inc.php link without using submit btn
    exit();
}