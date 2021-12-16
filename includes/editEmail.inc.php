<?php
//if a post action was entered by the button named "saveEmailBtn"...
if(isset($_POST["saveEmailBtn"])){

    //make super global variables from submitted form data
    $email = $_POST["editedEmail"];
    $pwd = $_POST["currentPWEditEM"];

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current email
    $currentEmail = $_SESSION["email"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for edit email------------------------------------------------
    if(emptyInputEditEM($email, $pwd) !== false){
        header("location: ../user.php?error=emptyInput");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../user.php?error=invalidEmail");
        exit();
    }
    if(sameEmail($connection, $email) !== false){
        header("location: ../user.php?error=sameEmail");
        exit();
    }
    if(alreadyExistsEM($connection, $email) !== false){
        header("location: ../user.php?error=emailTaken");
        exit();
    }

    editEmail($connection, $email, $pwd, $currentEmail);
}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter editUsername.inc.php link without using submit btn
    exit();
}