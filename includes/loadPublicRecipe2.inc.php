<?php
//if a post action was entered by the button named "loadRecipe"...
if(isset($_POST["loadRecipe"])){

    //make super global variables from submitted form data
    $recipeNameSelected = $_POST["publicRecipeInput"];//this is the numerical ID of the recipe name selected
    error_log("recipe name selected from loadRecipe page: ". $recipeNameSelected);

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //locate recipe----------------------------------------------------
    $loadedRecipe = loadPublicRecipe($connection, $recipeNameSelected);

    if(!$loadedRecipe){
        //check for recipe array-----------------------------
        error_log("no recipes located from loadRecipe()...");
        header("location: ../user.php");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
        exit();
    }
    else if($loadedRecipe){
        //check for recipe array------------------------------------------------------
        error_log("Recipe located from loadRecipe(): ". count($loadedRecipe));
        session_start();
        //prepare variables to enter into form-----------------------------------------
        $_SESSION["chefName"] = $loadedRecipe["publicRecipesUserName"];
        $_SESSION["recipeName"] = $loadedRecipe["publicRecipesTitle"];
        $_SESSION["loadedIngredients"] = $loadedRecipe["publicRecipesIngredients"];
        $_SESSION["loadedPreparation"] = $loadedRecipe["publicRecipesPreparation"];
        header("location: ../user.php?recipeDocument");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
        exit();
    }

}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
    exit();
}