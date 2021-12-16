<?php
//if a post action was entered by the button named "saveUsernameBtn"...
if(isset($_POST["saveUsernameBtn"])){

    //make super global variables from submitted form data
    $name = $_POST["editedusername"];
    $pwd = $_POST["currentPWEditUN"];

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current username
    $currentName = $_SESSION["username"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for edit username------------------------------------------------
    if(emptyInputEditUN($name, $pwd) !== false){
        header("location: ../user.php?error=emptyInput");
        exit();
    }
    if(invalidUsername($name) !== false){
        header("location: ../user.php?error=invalidUsername");
        exit();
    }
    if(alreadyExistsUN($connection, $name) !== false){
        header("location: ../user.php?error=nameTaken");
        exit();
    }

    editUsername($connection, $name, $pwd, $currentName);
}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter editUsername.inc.php link without using submit btn
    exit();
}