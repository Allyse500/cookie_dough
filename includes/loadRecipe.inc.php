<?php
//if a post action was entered by the button named "loadRecipe"...
if(isset($_POST["loadRecipe"])){

    //make super global variables from submitted form data
    $recipeNameSelected = $_POST["recipeInputName"];
    error_log("recipe name selected from loadRecipe page: ". $recipeNameSelected);
    //start up session to alter/obtain session variable(s)
    session_start();
    //declare variable of current user
    $user = $_SESSION["userId"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //locate recipe----------------------------------------------------
    $loadedRecipe = loadRecipe($connection, $user, $recipeNameSelected);

    if(!$loadedRecipe){
        //check for recipe array-----------------------------
        error_log("no recipes located from loadRecipe()...");
        header("location: ../user.php");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
        exit();
    }
    else if($loadedRecipe){
        //check for recipe array------------------------------------------------------
        error_log("Recipe located from loadRecipe(): ". count($loadedRecipe));

        //prepare variables to enter into form-----------------------------------------
        $_SESSION["recipeName"] = $loadedRecipe["recipesTitle"];
        $_SESSION["loadedIngredients"] = $loadedRecipe["recipesIngredients"];
        $_SESSION["loadedPreparation"] = $loadedRecipe["recipesPreparation"];
        header("location: ../user.php?recipe");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
        exit();
    }

}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
    exit();
}