<?php
//if a post action was entered by the button named "savePasswordBtn"...
if(isset($_POST["savePasswordBtn"])){

    //make super global variables from submitted form data
    $oldPW = $_POST["oldPassword"];
    $newPW = $_POST["newPassword"];
    $pwConfirm = $_POST["reEnteredNewPWD"];

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current email
    $currentEmail = $_SESSION["email"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for edit email------------------------------------------------
    if(emptyInputEditPW($oldPW, $newPW, $pwConfirm) !== false){
        header("location: ../user.php?error=emptyInput");
        exit();
    }
    // if(invalidEmail($email) !== false){
    //     header("location: ../user.php?error=invalidEmail");
    //     exit();
    // }
    if(pwdMatchEditPW($newPW, $pwConfirm) !== false){
        header("location: ../user.php?error=passwordsDontMatch");
        exit();
    }

    editPassword($connection, $oldPW, $newPW, $currentEmail);
}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter editPassword.inc.php link without using submit btn
    exit();
}