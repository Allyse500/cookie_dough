<?php
session_start();
$publicRecipeTitles = $_SESSION["recipeSearchArray"];
?>

<div id="publicRecipesModal">
    <div id="publicRecipesListContainer">
        <div id="publicRecipesListSecondaryContainer">
            <div id="publicRecipesListTitle">Public Recipes</div>
            <div id="publicRecipesList">
                <div id="numLoggedPublicRecipesMsg"><?php

                        error_log("recipe titles variable1: " . $publicRecipeTitles);
                        if (!$publicRecipeTitles){
                            echo "<span style='color:orange; font-weight:bold;'>0</span> recipes located."; 
                        }
                        else if ($publicRecipeTitles){
                            $num = count($publicRecipeTitles);
                            error_log("num variable: " . $num);
                            error_log("recipe titles variable2: " . $publicRecipeTitles);
                            if($num == 0 || !$publicRecipeTitles){
                                echo "<span style='color:orange; font-weight:bold;'>" . $num . "</span> recipes located.";
                            }
                            else if($num == 1){
                                echo "<span style='color:orange; font-weight:bold;'>" . $num . "</span> recipe located.";    
                            }
                            else if($num > 1){
                                echo "<span style='color:orange; font-weight:bold;'>" . count($publicRecipeTitles) . "</span> recipes located.";    
                            }
                        }
                    ?></div>
                <div id="publicRecipesInputContents">
                <?php
                        foreach ($publicRecipeTitles as $value) {
                            echo "<form class='recipeOpt' action='includes/loadPublicRecipe.inc.php' method='POST'><input style='display:none;' id='recipeInputName' name ='publicRecipeInput' value='" . $value["publicRecipeID"] . "'><button name='loadRecipe' class='recipeOptBtn'>". $value["publicRecipesUserName"] . ": ". $value["publicRecipesTitle"] . "</button></form>";
                        }     
                    ?>
                </div><!--end of id="publicRecipesInputContents", empty array of recipes -->
                <br>
                    <div id="publicRecipesCloseButton" onclick="closePublicRecipes()">Close</div>
            </div><!--end of id="publicRecipesList"-->
        </div><!--end of id="publicRecipesListSecondaryContainer-->
    </div><!--end of id="publicRecipesListContainer"-->
</div><!--end of id="publicRecipesModal"-->
