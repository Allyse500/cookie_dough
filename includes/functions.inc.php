<?php

////===================SIGN UP PROMPT BOX: ARE ANY FIELDS EMPTY?===========================
function emptyInputSignup($name, $email, $pwd, $pwdConfirm) {
    $result;
    if(empty($name) || empty($email) || empty($pwd) || empty($pwdConfirm)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//===================SIGN UP PROMPT BOX: IS USERNAME VALID?=================================
function invalidUsername($name) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//===================SIGN UP PROMPT BOX: IS EMAIL VALID?=================================
function invalidEmail($email) {
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//===================SIGN UP PROMPT BOX: PASSWORD AND CONFIRM PASSWORD MATCHES?===========
function pwdMatch($pwd, $pwdConfirm) {
    $result;
    if($pwd !== $pwdConfirm){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//====================SIGN UP PROMPT BOX: SEARCH FOR USER WITH ATTEMPTED USERNAME=====================================
function alreadyExists($connection, $name, $email) {
   $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
   $stmt = mysqli_stmt_init($connection);

//if there are any errors in the sql statement written
   if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../index.php?error=stmtFailed");
    exit();
   }

//bind the input variables to the stmt function--------------
    mysqli_stmt_bind_param($stmt, "ss", $name, $email);

//execute statement----------------
    mysqli_stmt_execute($stmt);

//get result of prepared statement--------------------
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){//if there is data in database with this username (also set located user as variable)
        return $row;//return all info of user located
    }
    else{//no user was located with that name/email
        $result = false;
        return $result;
    }

//close sql statement-------------------------
    mysqli_stmt_close($stmt);

}//end of alreadyExists()

//==================SIGN UP PROMPT BOX: PREPARE NEW USER========================
function createUser($connection, $name, $email, $pwd) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($connection);
 
 //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../index.php?error=stmtFailed");
     exit();
    }
    
    $hashedPW = password_hash($pwd, PASSWORD_DEFAULT);

 //bind the input variables to the stmt function--------------
     mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPW);
 
 //execute statement----------------
     mysqli_stmt_execute($stmt);
 
 //close sql statement-------------------------
     mysqli_stmt_close($stmt);
 
 //redirect user to front page with msg of sign up success
     header("location: ../index.php?error=none");
     exit();
 }//end of createUser()