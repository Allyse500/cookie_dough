<?php

//if a post action was entered by the button named "saveRecipe"...
if(isset($_POST["saveRecipe"])){

    //make super global variables from submitted form data
    $title = $_POST["recipeName"];
    $ingredients = $_POST["recipeIngredients"];
    $preparation = $_POST["recipePreparation"];

    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current user
    $user = $_SESSION["userId"];
    $currentTitle = $_SESSION["recipeName"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers for new recipe------------------------------------------------
    if(emptyInputNewRecipe($title) !== false){//re-use function, ignore title
        header("location: ../user.php?error=emptyRecipeTitle");
        exit();
    }
    if(recipeTitleInvalid($title) !== false){
        header("location: ../user.php?error=invalidRecipeTitle");
        exit();
    }
    if(recipeAlreadyExists($connection, $user, $title) !== false){
        header("location: ../user.php?error=recipenametaken");
        exit();
    }
    updateRecipe($connection, $user, $title, $currentTitle, $ingredients, $preparation);

}

//send user back to user.php if attempted to enter newRecipe.inc.php link without using submit btn
else{
header("location: ../user.php");//return user to user page
exit();
}