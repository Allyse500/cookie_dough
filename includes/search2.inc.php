<?php
//if a post action was entered by the button named "searchButton"...
if(isset($_POST["searchButton"])){
    session_start();
    //declare variable of search term
    $searchInput = $_POST["searchInput"];

    //import functions & variables from these files
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //locate recipe----------------------------------------------------
    $recipes = getPublicRecipes($connection, $searchInput);

    if(!$recipes){
        error_log("no recipes located...");
        header("location: ../user.php?searchResult");//send user back to user.php to display Search Result Prompt Box
        exit();
    }
    else if($recipes){
        //spotting variable type for trouble shooting-------------
        error_log("recipes variable type: ". gettype($recipes));
        error_log("number of recipes located: ". count($recipes));
        foreach ($recipes as $value) {
            error_log("Second attempt for recipe titles: " . $value["recipesTitle"]);
        }
        $_SESSION["recipeSearchArray"] = $recipes;
        header("location: ../user.php?searchResult");//send user back to user.php to display Search Result Prompt Box
        exit();
    }
}
else {
    header("location: ../user.php");//send user back to user.php if attempted to enter search.inc.php link without using submit btn
    exit();
}