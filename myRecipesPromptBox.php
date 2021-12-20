<?php
session_start();
?>

<div id="myRecipesModal">
    <div id="myRecipesListContainer">
        <div id="myRecipesListSecondaryContainer">
            <div id="myRecipesListTitle">My Recipes</div>
            <div id="myRecipesList">
                <div id="numLoggedRecipesMsg">
                    <?php
                        $recipeTitles = $_SESSION["recipeArray"];

                        error_log("recipe titles variable1: " . $recipeTitles);
                        if (!$recipeTitles){
                            echo "<span style='color:orange; font-weight:bold;'>0</span> logged recipes."; 
                        }
                        else if ($recipeTitles){
                            $num = count($recipeTitles);
                            error_log("num variable: " . $num);
                            error_log("recipe titles variable2: " . $recipeTitles);
                            if($num == 0 || !$recipeTitles){
                                echo "<span style='color:orange; font-weight:bold;'>" . $num . "</span> logged recipes.";
                            }
                            else if($num == 1){
                                echo "<span style='color:orange; font-weight:bold;'>" . $num . "</span> logged recipe.";    
                            }
                            else if($num > 1){
                                echo "<span style='color:orange; font-weight:bold;'>" . count($recipeTitles) . "</span> logged recipes.";    
                            }
                        }
                    ?>
                </div>
                <div id="myRecipesInputContents">
                    <?php
                        $recipeTitles = $_SESSION["recipeArray"];
                        foreach ($recipeTitles as $value) {
                            echo "<form class='recipeOpt' action='includes/loadRecipe.inc.php' method='POST'><input style='display:none;' id='recipeInputName' name ='recipeInputName' value='" . $value["recipesTitle"] . "'><button name='loadRecipe' class='recipeOptBtn'>" . $value["recipesTitle"] . "</button></form>";
                        }     
                    ?>
                </div><!--end of id="myRecipesInputContents", empty array of recipes -->
                <br>
                <div id="myRecipesBtnsGrid">
                    <div id="newRecipe" name="newRecipe" onclick="newRecipe()">New</div><div id="myRecipesCloseButton" onclick="closemyRecipes()">Close</div>
                </div><!-- end of id="myRecipesBtnsGrid" -->
            </div><!--end of id="myRecipesList"-->
        </div><!--end of id="myRecipesListSecondaryContainer-->
    </div><!--end of id="myRecipesListContainer"-->
</div><!--end of id="myRecipesModal"-->
