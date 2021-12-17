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

//===================SIGN UP PROMPT BOX: PASSWORD AND CONFIRM PASSWORD MATCH?===========
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

    //---------------------QUERY FOR USER'S RECIPES (IF ANY)----------------------------
    $id = $existingUser["usersID"];

    function getRecipes($connection, $id) {
        $sql = "SELECT recipesTitle FROM recipes WHERE recipesUser = ?;";
      
        $stmt = mysqli_stmt_init($connection);
    
    //if there are any errors in the sql statement written
        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtFailed");
        exit();
        }
    
    //bind the input variables to the stmt function--------------
        mysqli_stmt_bind_param($stmt, "i", $id);
    
    //execute statement----------------
        mysqli_stmt_execute($stmt);
    
    //get result of prepared statement--------------------
        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_all($resultData, MYSQLI_ASSOC)){//if there is data in database with this user ID (also set located user as variable)
            error_log("row variable: " . gettype($row));
            error_log("count of row array: " . count($row));

            foreach ($row as $value) {
                error_log("Attempt for recipe titles: " . $value["recipesTitle"]);
            }

            return $row;//return all info of user located
        }
        else{//no recipes were located with that user's ID
            $result = false;
            return $result;
        }
    
    //close sql statement-------------------------
        mysqli_stmt_close($stmt);
    
    }//end of getRecipes()
    $recipes = getRecipes($connection, $id);//call the function and set to variable

    if(!$recipes){
        error_log("no recipes located...");
    }
    else if($recipes){
        //spotting variable type for trouble shooting-------------
        // error_log("recipes variable type: ". gettype($recipes));
        // error_log("number of recipes located: ". count($recipes));
        // foreach ($recipes as $value) {
        //     error_log("Second attempt for recipe titles: " . $value["recipesTitle"]);
        // }

        $_SESSION["recipeArray"] = $recipes;

    }

    //send user to user's profile page-------------------
    header("location: ../user.php");
    exit();
 }//end of else if($checkPW === true)
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

//=====================EDIT USERNAME PROMPT: ARE THE ENTRIES THE SAME?=========================
function sameUsername($currentName, $name){
    $result;
    if($currentName == $name){
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
            exit();
        }
        //if password was correct----------------------------------
        else if($checkPW === true){

            //define variable of id for query---------------------
            $id = $currentUser["usersID"];
            
            //update user acct with requested username--------------
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
                    header("location: ../user.php?error=notUptated");
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

//=====================EDIT EMAIL PROMPT: ARE ANY FIELDS EMPTY?===========================
function emptyInputEditEM($email, $pwd) {
    $result;
    if(empty($email) || empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=====================EDIT EMAIL PROMPT: ARE THE ENTRIES THE SAME?=========================
function sameEmail($currentEmail, $email){
    $result;
    if($currentEmail == $email){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=======================EDIT EMAIL ==============================================
//-----------------------QUERY FOR USER WITH ATTEMPTED EMAIL-----------------
function alreadyExistsEM($connection, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
 
    //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../user.php?error=stmtFailed");
     exit();
    }
 
    //bind the input variables to the stmt function--------------
     mysqli_stmt_bind_param($stmt, "s", $email);
 
    //execute statement----------------
     mysqli_stmt_execute($stmt);
 
    //get result of prepared statement--------------------
     $resultData = mysqli_stmt_get_result($stmt);
 
     if($row = mysqli_fetch_assoc($resultData)){//if there is data in database with this email (also set located user as variable)
         return $row;//return all info of user located
     }
     else{//no user was located with that email
         $result = false;
         return $result;
     }
 
    //close sql statement-------------------------
     mysqli_stmt_close($stmt);
 
 }//end of alreadyExistsEM()

//-----------------------QUERY FOR USER'S CURRENT EMAIL----------------------------
function currentUserEmail($connection, $currentEmail) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    error_log("user's current email from currentUserEmail(): " . $currentEmail);
    error_log("variable type of currentEmail variable: " . gettype($currentEmail));
    //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../user.php?error=stmtFailed");
    error_log("statement failed from currentUserEmail()");
    exit();
    }

    //bind the input variables to the stmt function--------------
    mysqli_stmt_bind_param($stmt, "s", $currentEmail);

    //execute statement----------------
    mysqli_stmt_execute($stmt);

    //get result of prepared statement--------------------
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){//if there is data in database with this email (also set located user as variable)
        return $row;//return all info of user located
    }
    else{//no user was located with that email
        $result = false;
        return $result;
    }

    //close sql statement-------------------------
    mysqli_stmt_close($stmt);

}//end of currentUserEmail()


//----------------------------EDIT EMAIL-----------------------------------------
function editEmail($connection, $email, $pwd, $currentEmail){
    
    $existingUser = alreadyExistsEM($connection, $email);
    $currentUser = currentUserEmail($connection, $currentEmail);
    
    if($existingUser === false){//if user not located with that email-------------
        
        //check if password matches---------------------------------
        $hashedPW = $currentUser["usersPwd"];//password of DB
        $checkPW = password_verify($pwd, $hashedPW);//compare password from input to pw of DB

        //if password did not match--------------------------------
        if($checkPW === false){
            header("location: ../user.php?error=wrongPW");
            exit();
        }
        //if password was correct----------------------------------
        else if($checkPW === true){

            //define variable of id for query---------------------
            $id = $currentUser["usersID"];
            
            //update user acct with requested email--------------
            function changeEM($connection, $email, $id) {
                $sql = "UPDATE `users` SET `usersEmail` = '". $email ."' WHERE `users`.`usersID` = '". $id."';";
    
                $stmt = mysqli_stmt_init($connection);
                                
                //if there are any errors in the sql statement written
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../user.php?error=stmtFailed");
                    error_log("statement failed at changeEM()...");
                    exit();
                }
                //execute update request--------------------------
                $updateResult = mysqli_query($connection, $sql);
                if ($updateResult) {
                    error_log("Record updated successfully");
                    //re-define email for session----------------------
                    $_SESSION["email"] = $email;
                } else {
                    error_log("Error updating record: " . mysqli_error($connection));
                    header("location: ../user.php?error=notUptated");
                    exit();
                }
                //close sql statement-----------------------------
                mysqli_close($connection);
            
            }//end of changeEM()

            changeEM($connection, $email, $id);//call the function

            //send user to user's profile page-------------------
            header("location: ../user.php?error=noneEditEM");
            exit();
        }//end of else if($checkPW === true)
    }//end of if($existingUser === false)

    //if a user was located with the attempted email----------------------
    else if($existingUser === true){
        header("location: ../user.php?error=emailTaken");
        exit();
    }

}//end of editEmail()

//=====================EDIT PASSWORD PROMPT: ARE ANY FIELDS EMPTY?===========================
function emptyInputEditPW($oldPW, $newPW, $pwConfirm) {
    $result;
    if(empty($oldPW) || empty($newPW) || empty($pwConfirm)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//===================PASSWORD EDIT PROMPT: PASSWORD AND CONFIRM PASSWORD MATCH?===========
function pwdMatchEditPW($newPW, $pwConfirm) {
    $result;
    if($newPW !== $pwConfirm){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=======================UPDATE PASSWORD ==============================================

function editPassword($connection, $oldPW, $newPW, $currentEmail){
    $currentUser = currentUserEmail($connection, $currentEmail);
    
    if(!$currentUser){
        header("location: ../user.php?error=notUptated");
        exit();
    }//end of if(!$currentUser)

    //if a user was not located with the attempted email----------------------
    else if($currentUser){
        
        $hashedPW = $currentUser["usersPwd"];
        $checkPW = password_verify($oldPW, $hashedPW);
        
        if($checkPW === false){
            header("location: ../user.php?error=wrongPW");
            exit();
        }
        else if($checkPW === true){
            //define variable of id for query---------------------
            $id = $currentUser["usersID"];
            
            //update user acct with requested password--------------
            $newHashedPW = password_hash($newPW, PASSWORD_DEFAULT);
            
            function changePW($connection, $newHashedPW, $id) {
                $sql = "UPDATE `users` SET `usersPwd` = '". $newHashedPW ."' WHERE `users`.`usersID` = '". $id."';";
                
                $stmt = mysqli_stmt_init($connection);
                                
                //if there are any errors in the sql statement written
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../user.php?error=stmtFailed");
                    error_log("statement failed at changePW()...");
                    exit();
                }
                //execute update request--------------------------
                $updateResult = mysqli_query($connection, $sql);
                if ($updateResult) {
                    error_log("Record updated successfully");
                    //re-define password for session----------------------
                    $_SESSION["userPW"] = $newPW;
                } else {
                    error_log("Error updating record: " . mysqli_error($connection));
                    header("location: ../user.php?error=notUptated");
                    exit();
                }
                //close sql statement-----------------------------
                mysqli_close($connection);
                
            }//end of changePW()
            
            changePW($connection, $newHashedPW, $id);//call the function
            
            //send user to user's profile page-------------------
            header("location: ../user.php?error=noneEditPW");
            exit();
        }//end of else if($checkPW === true)
    }//end of else if($currentUser)
}//end of editPassword()

//=====================DELETE ACCT PROMPT: ARE ANY FIELDS EMPTY?===========================
function emptyInputDeleteAcct($pwd) {
    $result;
    if(empty($pwd)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=======================DELETE ACCT ==============================================

function deleteAcct($connection, $pwd, $currentEmail){
    $currentUser = currentUserEmail($connection, $currentEmail);
    
    if(!$currentUser){
        header("location: ../user.php?error=notUptated");
        exit();
    }//end of if(!$currentUser)

    //if a user was not located with the attempted email----------------------
    else if($currentUser){
        
        $hashedPW = $currentUser["usersPwd"];
        $checkPW = password_verify($pwd, $hashedPW);
        
        if($checkPW === false){
            header("location: ../user.php?error=wrongPW");
            exit();
        }
        else if($checkPW === true){
            //define variable of id for query---------------------
            $id = $currentUser["usersID"];
            
            //delete user account---------------------------------
            
            function deleteUser($connection,  $id) {
                $sql = "DELETE FROM `users` WHERE `users`.`usersID` = '". $id."';";
                
                $stmt = mysqli_stmt_init($connection);
                                
                //if there are any errors in the sql statement written
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../user.php?error=stmtFailed");
                    error_log("statement failed at deleteUser()...");
                    exit();
                }
                //execute update request--------------------------
                $updateResult = mysqli_query($connection, $sql);
                if ($updateResult) {
                    error_log("Record updated successfully");
                } else {
                    error_log("Error updating record: " . mysqli_error($connection));
                    header("location: ../user.php?error=notUptated");
                    exit();
                }
                //close sql statement-----------------------------
                mysqli_close($connection);
                
            }//end of deleteUser()
            
            deleteUser($connection,  $id);//call the function
            
            //send user to index page and logout-------------------
            header("location: ../index.php?error=noneAcctDeleted");
            exit();
        }//end of else if($checkPW === true)
    }//end of else if($currentUser)
}//end of deleteAcct()

//=====================NEW RECIPE PROMPT BOX: ARE ANY FIELDS EMPTY?===========================
function emptyInputNewRecipe($title) {
    $result;
    if(empty($title)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//=======================INSERT NEW RECIPE ==============================================
//-----------------------QUERY FOR USER'S RECIPE WITH ATTEMPTED TITLE-----------------
function recipeAlreadyExists($connection, $user, $title) {
    $sql = "SELECT * FROM recipes WHERE recipesUser = ? AND recipesTitle = ?;";
    $stmt = mysqli_stmt_init($connection);
 
    //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
     header("location: ../user.php?error=stmtFailed");
     exit();
    }
 
    //bind the input variables to the stmt function--------------
     mysqli_stmt_bind_param($stmt, "is", $user, $title);
 
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
 
 }//end of recipeAlreadyExists()

//-----------------------QUERY FOR CURRENT USER'S ID---------------------------
function currentUserID($connection, $user) {
    $sql = "SELECT * FROM users WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($connection);
    error_log("user's current id from currentUserID(): " . $user);
    error_log("variable type of currentUserID variable: " . gettype($user));
    //if there are any errors in the sql statement written
    if(!mysqli_stmt_prepare($stmt, $sql)){
    header("location: ../user.php?error=stmtFailed");
    error_log("statement failed from currentUserID()");
    exit();
    }

    //bind the input variables to the stmt function--------------
    mysqli_stmt_bind_param($stmt, "i", $user);

    //execute statement----------------
    mysqli_stmt_execute($stmt);

    //get result of prepared statement--------------------
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){//if there is data in database with this id (also set located user as variable)
        return $row;//return all info of user located
    }
    else{//no user was located with that id
        $result = false;
        return $result;
    }

    //close sql statement-------------------------
    mysqli_stmt_close($stmt);

}//end of currentUserID()

//----------------------------INSERT NEW RECIPE-----------------------------------------
function createRecipe($connection, $user, $title, $ingredients, $preparation){
    
    $existingRecipe = recipeAlreadyExists($connection, $user, $title);
    $currentUser = currentUserID($connection, $user);
    
    if($existingRecipe === false){//if recipe name not located under user's ID-------------
        
        //define variable of id for query---------------------
        //$id = $currentUser["usersID"];
            
        //prepare new recipe entry with user's id--------------
        function makeNewRecipe($connection, $user, $title, $ingredients, $preparation) {
            $sql = "INSERT INTO `recipes`(`recipesUser`, `recipesTitle`, `recipesIngredients`, `recipesPreparation`) VALUES ('" . $user . "','" . $title ."','" . $ingredients . "','" . $preparation . "');";
            //$sql = "INSERT INTO recipes (recipesUser, recipesTitle, recipesIngredients, recipesPreparation) VALUES (?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($connection);
            error_log("make new recipe with these variables: " . $user . ", " . $title . ", " . $ingredients . ", " . $preparation);                    
            error_log("sql statement used: ". $sql);
            //if there are any errors in the sql statement written
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("location: ../user.php?error=stmtFailed");
                error_log("statement failed at makeNewRecipe()...");
                exit();
            }
            //execute update request--------------------------
            $updateResult = mysqli_query($connection, $sql);
            if ($updateResult) {
                error_log("Record updated successfully");
                //re-define recipe title for session----------------------
                $_SESSION["newRecipeTitle"] = $title;

                //---------------------QUERY FOR USER'S RECIPES (IF ANY)----------------------------
                //$id = $existingUser["usersID"];

                function getRecipes($connection, $user) {
                    $sql = "SELECT recipesTitle FROM recipes WHERE recipesUser = ?;";
                
                    $stmt = mysqli_stmt_init($connection);
                
                    //if there are any errors in the sql statement written
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../index.php?error=stmtFailed");
                    exit();
                    }
                
                    //bind the input variables to the stmt function--------------
                    mysqli_stmt_bind_param($stmt, "i", $user);
                
                    //execute statement----------------
                    mysqli_stmt_execute($stmt);
                
                    //get result of prepared statement--------------------
                    $resultData = mysqli_stmt_get_result($stmt);

                    if($row = mysqli_fetch_all($resultData, MYSQLI_ASSOC)){//if there is data in database with this user ID (also set located user as variable)
                        error_log("row variable: " . gettype($row));
                        error_log("count of row array: " . count($row));

                        foreach ($row as $value) {
                            error_log("Attempt for recipe titles: " . $value["recipesTitle"]);
                        }

                        return $row;//return all info of user located
                    }
                    else{//no recipes were located with that user's ID
                        $result = false;
                        return $result;
                    }
                
                //close sql statement-------------------------
                    mysqli_stmt_close($stmt);
                
                }//end of getRecipes()
                $recipes = getRecipes($connection, $user);//call the function and set to variable

                if(!$recipes){
                    error_log("no recipes located...");
                }
                else if($recipes){
                    //spotting variable type for trouble shooting-------------
                    error_log("recipes variable type: ". gettype($recipes));
                    error_log("number of recipes located: ". count($recipes));
                    foreach ($recipes as $value) {
                        error_log("Second attempt for recipe titles: " . $value["recipesTitle"]);
                    }
                    $_SESSION["recipeArray"] = $recipes;
                }//end of else if($recipes)
                
            } else {
                error_log("Error updating record: " . mysqli_error($connection));
                header("location: ../user.php?error=notUptated");
                exit();
            }
            //close sql statement-----------------------------
            mysqli_close($connection);
            
        }//end of makeNewRecipe()

        makeNewRecipe($connection, $user, $title, $ingredients, $preparation);//call the function

        //send user to user's profile page-------------------
        header("location: ../user.php?error=recipeSubmitted");
        exit();
    }//end of if($existingRecipe === false)

    //if a user was located with the attempted name----------------------
    else if($existingRecipe === true){
        header("location: ../user.php?error=recipeNameTaken");
        exit();
    }

}//end of createRecipe()
