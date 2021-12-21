<?php

//if a post action was entered by the button named "messageCloseButton"...
if(isset($_POST["messageCloseButton"])){

    header("location: ../user.php?recipeBack");//pull up Recipe prompt box
    exit();
}

//send user back to user.php if attempted to enter newRecipe.inc.php link without using submit btn
else{
header("location: ../user.php");//return user to user page
exit();
}