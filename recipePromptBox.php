<?php
session_start();
$name = $_SESSION["username"];
$recipeTitle = $_SESSION["recipeName"];
$ingredients = $_SESSION["loadedIngredients"];
$preparation = $_SESSION["loadedPreparation"];
?>

<div id="recipeModal">
    <div id="recipeContainer">
        <div id="recipeSecondaryContainer">
            <form id="editRecipeForm" action="includes/editRecipe.inc.php" method="POST">
                <div id="recipeHeaderGrid">
                    <div id="recipeModalBackBtn" onclick="recipeModalBackBtn()">&larr;</div><div id="recipeFormTitle">Recipe</div>
                </div><!--end of id="recipeHeaderGrid"-->
                <label for="recipeTitle" class="recipeLabel">Title: </label>
                <input id="recipeTitle" type="text" name="recipeName" value="<?php echo $recipeTitle; ?>">
                <div id="ingredientsTitle" class="recipeLabel">Ingredients:</div>
                <textarea id="ingredients" name="recipeIngredients" class="recipeInputs textarea" rows="7" cols="32">
                    <?php
                    echo $ingredients;
                    ?>
                </textarea>
                <div id="preparationTitle" class="recipeLabel">Preparation:</div>
                <textarea id="preparation" name="recipePreparation" class="recipeInputs textarea" rows="8" cols="32">
                    <?php
                    echo $preparation;
                    ?>
                </textarea>
                <br>
                <div id="recipeBtnsGrid">
                    <div id="delRecipe" class="recipeBtn recipeBtnDiv" onclick="drcModal()">Delete</div><button id="saveRecipe" class="recipeBtn" name="saveRecipe">Save</button><div id="recipeCloseButton" class="recipeBtn recipeBtnDiv" onclick="closerecipe()">Close</div>
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
                <form id="drcDelBtnForm" action="delRecipe.php" method="POST"><button id="drcDelBtn" class="drcBtns" name="drcDelBtn">Delete</button></form><div id="drcCancelButton" class="drcBtns drcBtnsDiv" onclick="canceldrc()">Cancel</div>
            </div><!--end of id="drcDelBtnsGrid"-->
        </div><!--end of id="drcSecondaryContainer-->
    </div><!--end of id="drcContainer"-->
</div><!--end of id="drcModal"-->