<?php

//if a post action was entered by the button named "saveRecipe"...
if(isset($_POST["saveRecipe"])){

    //make super global variables from submitted form data
    $title = trim($_POST["recipeName"]);
    $ingredients = trim($_POST["recipeIngredients"]);
    $preparation = trim($_POST["recipePreparation"]);
    $postToPublic = $_POST["makePublic"];

    error_log("type of input from post to public checkbox: " . gettype($postToPublic));

    if(!$postToPublic){
        error_log("user does not want this recipe in public recipe db");
    }
    else if($postToPublic){
        error_log("user wants this recipe in public recipe db");
    }
    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current user
    $user = $_SESSION["userId"];
    $currentTitle = $_SESSION["recipeName"];
    $chef = $_SESSION["username"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for new recipe------------------------------------------------
    if(emptyInputNewRecipe($title) !== false){//re-use function, ignore title
        header("location: ../user.php?error=emptyRecipeTitle");
        $_SESSION["temporaryRecipeTitle"] = $title;
        $_SESSION["temporaryIngredients"] = $ingredients;
        $_SESSION["temporaryPreparation"] = $preparation;
        exit();
    }
    if(recipeTitleInvalid($title) !== false){
        header("location: ../user.php?error=invalidRecipeTitle");
        $_SESSION["temporaryRecipeTitle"] = $title;
        $_SESSION["temporaryIngredients"] = $ingredients;
        $_SESSION["temporaryPreparation"] = $preparation;
        exit();
    }
    //if no errors located:------------------------------------------------------
    //-----------------------update recipe---------------------------------------
    updateRecipe($connection, $user, $title, $currentTitle, $ingredients, $preparation, $postToPublic, $chef);
    $_SESSION["temporaryRecipeTitle"] = "";
    $_SESSION["temporaryIngredients"] = "";
    $_SESSION["temporaryPreparation"] = "";
}
else if(isset($_POST["recipeModalBackBtn"])){//if post method was submitted by button named "recipeModalBackBtn"
    header("location: ../user.php?myRecipes");//pull up My Recipes prompt box
    exit();
}
else if(isset($_POST["recipeCloseButton"])){
    $_SESSION["temporaryRecipeTitle"] = "";
    $_SESSION["temporaryIngredients"] = "";
    $_SESSION["temporaryPreparation"] = "";
    header("location: ../user.php");//return user to user page
    exit();
}
//send user back to user.php if attempted to enter newRecipe.inc.php link without using submit btn
else{
header("location: ../user.php");//return user to user page
exit();
}