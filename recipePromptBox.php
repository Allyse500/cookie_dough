<?php
session_start();
$name = $_SESSION["username"];
$recipeTitle = $_SESSION["recipeName"];
$ingredients = $_SESSION["loadedIngredients"];
$preparation = $_SESSION["loadedPreparation"];

$tempTitle = $_SESSION["temporaryRecipeTitle"];
$tempIngredients = $_SESSION["temporaryIngredients"];
$tempPreparation = $_SESSION["temporaryPreparation"];
?>

<div id="recipeModal">
    <div id="recipeContainer">
        <div id="recipeSecondaryContainer">
            <form id="editRecipeForm" action="includes/editRecipe.inc.php" method="POST">
                <div id="recipeHeaderGrid">
                    <button id="recipeModalBackBtn" name="recipeModalBackBtn">&larr;</button><div id="recipeFormTitle">Recipe</div><div><input type="checkbox" id="makePublic" name="makePublic"><label for="makePublic" class="publicCheckBoxLabel">public</label></div>
                </div><!--end of id="recipeHeaderGrid"-->
                <label for="recipeTitle" class="recipeLabel">Title: </label>
                <input id="recipeTitle" type="text" name="recipeName" value="<?php if(isset($_GET["recipe"])){echo $recipeTitle;} else if(isset($_GET["recipeBack"])){echo $tempTitle;} ?>">
                <div id="ingredientsTitle" class="recipeLabel">Ingredients:</div>
                <textarea id="ingredients" name="recipeIngredients" class="recipeInputs textarea" rows="7" cols="32">
                    <?php
                        if(isset($_GET["recipe"])){
                            echo $ingredients;
                        }
                        else if(isset($_GET["recipeBack"])){
                            echo $tempIngredients;
                        }
                    ?>
                </textarea>
                <div id="preparationTitle" class="recipeLabel">Preparation:</div>
                <textarea id="preparation" name="recipePreparation" class="recipeInputs textarea" rows="8" cols="32">
                    <?php
                        if(isset($_GET["recipe"])){
                            echo $preparation;
                        }
                        else if(isset($_GET["recipeBack"])){
                            echo $tempPreparation;
                        }
                    ?>
                </textarea>
                <br>
                <div id="recipeBtnsGrid">
                    <div id="delRecipe" class="recipeBtn recipeBtnDiv" onclick="drcModal()">Delete</div><button id="saveRecipe" class="recipeBtn" name="saveRecipe">Save</button><button id="recipeCloseButton" name="recipeCloseButton" class="recipeBtn recipeBtnDiv">Close</button>
                </div><!-- end of id="recipeBtnsGrid" -->
            </form><!-- end of id="editRecipeForm" -->
        </div><!--end of id="recipeSecondaryContainer-->
    </div><!--end of id="recipeContainer"-->
</div><!--end of id="recipeModal"-->

<!--=====================DELETE RECIPE CONFIRMATION PROMPT BOX=================================-->
<div id="drcModal">
    <div id="drcContainer">
        <div id="drcSecondaryContainer">
            <div id="drcTitle">Delete Recipe</div>
            <div id="drcContents">
                <div id="drcNameField">Recipe Name: <span id="drcRecipeName"><?php echo $recipeTitle; ?></span></div>
                Are you sure you would like to delete this recipe?
            </div><!--end of id="drcContents"-->
            <div id="drcDelBtnsGrid">
                <form id="drcDelBtnForm" action="includes/delRecipe.inc.php" method="POST"><button id="drcDelBtn" class="drcBtns" name="drcDelBtn">Delete</button></form><div id="drcCancelButton" class="drcBtns drcBtnsDiv" onclick="canceldrc()">Cancel</div>
            </div><!--end of id="drcDelBtnsGrid"-->
        </div><!--end of id="drcSecondaryContainer-->
    </div><!--end of id="drcContainer"-->
</div><!--end of id="drcModal"-->