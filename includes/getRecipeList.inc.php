<?php
//if a post action was entered by the button named "myRecipesBtn"...
if(isset($_POST["myRecipesBtn"])){
    session_start();
    //declare variable of current user
    $id = $_SESSION["userId"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //locate recipe----------------------------------------------------
    $recipes = getRecipes($connection, $id);

    if(!$recipes){
        error_log("no recipes located...");
        header("location: ../user.php?myRecipes");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
        exit();
    }
    else if($recipes){
        //spotting variable type for trouble shooting-------------
        // error_log("recipes variable type: ". gettype($recipes));
        // error_log("number of recipes located: ". count($recipes));
        // foreach ($recipes as $value) {
        //     error_log("Second attempt for recipe titles: " . $value["recipesTitle"]);
        // }
        $_SESSION["recipeArray"] = $recipes;
        header("location: ../user.php?myRecipes");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
        exit();
    }
}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter editEmail.inc.php link without using submit btn
    exit();
}