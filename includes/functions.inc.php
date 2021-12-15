<?php

//=====================SIGN UP PROMPT BOX: ARE ANY FIELDS EMPTY?===========================
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

//===================SIGN UP PROMPT BOX || EDIT USERNAME PROMPT BOX: IS USERNAME VALID?=================================
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

 //=====================LOGIN PROMPT BOX: ARE ANY FIELDS EMPTY?===========================
function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=======================LOG IN USER ==============================================

function loginUser($connection, $username, $pwd){
 $existingUser = alreadyExists($connection, $username, $username);
 
 if($existingUser === false){
    header("location: ../index.php?error=wrongLogin");
    exit();
 }

 $hashedPW = $existingUser["usersPwd"];
 $checkPW = password_verify($pwd, $hashedPW);

 if($checkPW === false){
    header("location: ../index.php?error=wrongLogin");
    exit();
 }
 else if($checkPW === true){
    session_start();//make login session

    //define variables for session----------------------
    $_SESSION["userId"] = $existingUser["usersID"];
    $_SESSION["username"] = $existingUser["usersName"];
    $_SESSION["email"] = $existingUser["usersEmail"];
    $_SESSION["userPW"] = $existingUser["usersPwd"];

    //send user to user's profile page-------------------
    header("location: ../user.php");
    exit();
 }

}//end of loginUser()

 //=====================EDIT USERNAME PROMPT: ARE ANY FIELDS EMPTY?===========================
 function emptyInputEditUN($name, $pwd) {
    $result;
    if(empty($name) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=======================EDIT USERNAME ==============================================
//-----------------------QUERY FOR USER WITH ATTEMPTED USERNAME-----------------
function alreadyExistsUN($connection, $name) {
    $sql = "SELECT * FROM users WHERE usersName = ?;";
    $stmt = mysqli_stmt_init($connection);
 
    //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../user.php?error=stmtFailed");
     exit();
    }
 
    //bind the input variables to the stmt function--------------
     mysqli_stmt_bind_param($stmt, "s", $name);
 
    //execute statement----------------
     mysqli_stmt_execute($stmt);
 
    //get result of prepared statement--------------------
     $resultData = mysqli_stmt_get_result($stmt);
 
     if($row = mysqli_fetch_assoc($resultData)){//if there is data in database with this username (also set located user as variable)
         return $row;//return all info of user located
     }
     else{//no user was located with that name
         $result = false;
         return $result;
     }
 
    //close sql statement-------------------------
     mysqli_stmt_close($stmt);
 
 }//end of alreadyExistsUN()

//-----------------------QUERY FOR USER'S CURRENT NAME----------------------------
function currentUser($connection, $currentName) {
    $sql = "SELECT * FROM users WHERE usersName = ?;";
    $stmt = mysqli_stmt_init($connection);
    error_log("user's current name from currentUser(): " . $currentName);
    error_log("variable type of currentName variable: " . gettype($currentName));
    //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../user.php?error=stmtFailed");
    error_log("statement failed from currentUser()");
    exit();
    }

    //bind the input variables to the stmt function--------------
    mysqli_stmt_bind_param($stmt, "s", $currentName);

    //execute statement----------------
    mysqli_stmt_execute($stmt);

    //get result of prepared statement--------------------
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){//if there is data in database with this username (also set located user as variable)
        return $row;//return all info of user located
    }
    else{//no user was located with that name
        $result = false;
        return $result;
    }

    //close sql statement-------------------------
    mysqli_stmt_close($stmt);

}//end of currentUser()


//----------------------------EDIT USERNAME-----------------------------------------
function editUsername($connection, $name, $pwd, $currentName){
    
    $existingUser = alreadyExistsUN($connection, $name);
    $currentUser = currentUser($connection, $currentName);
    
    if($existingUser === false){//if user not located with that name-------------
        
        //check if password matches---------------------------------
        $hashedPW = $currentUser["usersPwd"];//password of DB
        $checkPW = password_verify($pwd, $hashedPW);//compare password from input to pw of DB

        //if password did not match--------------------------------
        if($checkPW === false){
            header("location: ../user.php?error=wrongPW");
            error_log("current user located: " . $currentUser);
            exit();
        }
        //if password was correct----------------------------------
        else if($checkPW === true){

            //define variable of id for query---------------------
            $id = $currentUser["usersID"];
            
            //query for user with attempted username--------------
            function changeUN($connection, $name, $id) {
                //$sql = "UPDATE `users` SET `usersName` = '?' WHERE `usersID` = '?';";
                $sql = "UPDATE `users` SET `usersName` = '". $name ."' WHERE `users`.`usersID` = '". $id."';";
    
                $stmt = mysqli_stmt_init($connection);
                                
                //if there are any errors in the sql statement written
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../user.php?error=stmtFailed");
                    error_log("statement failed at changeUN()...");
                    exit();
                }
                //execute update request--------------------------
                $updateResult = mysqli_query($connection, $sql);
                if ($updateResult) {
                    error_log("Record updated successfully");
                    //re-define username for session----------------------
                    $_SESSION["username"] = $name;
                } else {
                    error_log("Error updating record: " . mysqli_error($connection));
                    header("location: ../user.php?error=unNotUptated");
                    exit();
                }
                //close sql statement-----------------------------
                mysqli_close($connection);
            
            }//end of changeUN()

            changeUN($connection, $name, $id);//call the function

            //send user to user's profile page-------------------
            header("location: ../user.php?error=noneEditUN");
            exit();
        }//end of else if($checkPW === true)
    }//end of if($existingUser === false)

    //if a user was located with the attempted name----------------------
    else if($existingUser === true){
        header("location: ../user.php?error=nameTaken");
        exit();
    }

}//end of editUsername()