<?php

//if a post action was entered by the button named "saveNewRecipe"...
if(isset($_POST["saveNewRecipe"])){

    //make super global variables from submitted form data
    $title = $_POST["newRecipeTitle"];
    $ingredients = $_POST["newIngredients"];
    $preparation = $_POST["newPreparation"];

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current user
    $user = $_SESSION["userId"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for new recipe------------------------------------------------
    if(emptyInputNewRecipe($title) !== false){
        header("location: ../user.php?error=emptyTitle");
        $_SESSION["temporaryRecipeTitle"] = $title;
        $_SESSION["temporaryIngredients"] = $ingredients;
        $_SESSION["temporaryPreparation"] = $preparation;
        exit();
    }
    if(recipeAlreadyExists($connection, $user, $title) !== false){
        header("location: ../user.php?error=recipeNameTaken");
        $_SESSION["temporaryRecipeTitle"] = $title;
        $_SESSION["temporaryIngredients"] = $ingredients;
        $_SESSION["temporaryPreparation"] = $preparation;
        exit();
    }
    createRecipe($connection, $user, $title, $ingredients, $preparation);
    $_SESSION["temporaryRecipeTitle"] = "";
    $_SESSION["temporaryIngredients"] = "";
    $_SESSION["temporaryPreparation"] = "";

}
//if a post action was entered by the button named "newRecipeCancelButton"...
else if(isset($_POST["newRecipeCancelButton"])){

    //clear entry super global variables for form
    $_POST["newRecipeTitle"] = "";
    $_POST["newIngredients"] = "";
    $_POST["newPreparation"] = "";

    session_start();
    $_SESSION["temporaryRecipeTitle"] = "";
    $_SESSION["temporaryIngredients"] = "";
    $_SESSION["temporaryPreparation"] = "";
    //send user back to user page---------------------------------
    header("location: ../user.php");//return user to user page
    exit();
}

//send user back to user.php if attempted to enter newRecipe.inc.php link without using submit btn
else{
header("location: ../user.php");//return user to user page
exit();
}