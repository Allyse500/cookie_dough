<?php

//if a post action was entered by the button named "messageCloseButton"...
if(isset($_POST["messageCloseButton"])){

    //make super global variables from submitted form data
    // $title = $_POST["recipeName"];
    // $ingredients = $_POST["recipeIngredients"];
    // $preparation = $_POST["recipePreparation"];
    //start session to make global variables
    session_start();
    //make temporary variables to help keep user's place
    // $_SESSION["temporaryRecipeTitle"] = $title;
    // $_SESSION["temporaryIngredients"] = $ingredients;
    // $_SESSION["temporaryPreparation"] = $preparation;
    header("location: ../user.php?recipeBack");//pull up Recipe prompt box
    exit();
}

//send user back to user.php if attempted to enter newRecipe.inc.php link without using submit btn
else{
header("location: ../user.php");//return user to user page
exit();
}