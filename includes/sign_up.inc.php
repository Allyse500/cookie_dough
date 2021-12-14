<?php

//if a post action was entered by the button named "submitSignUp"...
if(isset($_POST["submitSignUp"])){

    //make super global variables from submitted form data
    $name = $_POST["newUsername"];
    $email = $_POST["newUserEmail"];
    $pwd = $_POST["newPassword"];
    $pwdConfirm = $_POST["confirmNewPassword"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for sign up------------------------------------------------
    //
    if(emptyInputSignup($name, $email, $pwd, $pwdConfirm) !== false){
        header("location: ../index.php?error=emptyInput");
        exit();
    }
    if(invalidUsername($name) !== false){
        header("location: ../index.php?error=invalidUsername");
        exit();
    }
    if(invalidEmail($email) !== false){
        header("location: ../index.php?error=invalidEmail");
        exit();
    }
    if(pwdMatch($pwd, $pwdConfirm) !== false){
        header("location: ../index.php?error=passwordsDontMatch");
        exit();
    }
    if(alreadyExists($connection, $name, $email) !== false){
        header("location: ../index.php?error=nameTaken");
        exit();
    }
    createUser($connection, $name, $email, $pwd);

}

//if a post action was not entered by the button named "submitSignUp" (and user is trying to enter page "http://localhost:3000/includes/sign_up.inc.php")
else{
header("location: ../index.php");//return user to home page
exit();
}