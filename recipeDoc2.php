<?php
session_start();
$chef = $_SESSION["chefName"];
$title = $_SESSION["recipeName"];
$ingredients = $_SESSION["loadedIngredients"];
$preparation = $_SESSION["loadedPreparation"];
?>
<div id="documentModal">
    <div id="documentGrid">
        <div id="document">
            <div id="documentContents">
                <div class="recipeDocTitle"><?php echo $chef . ": <span style='color:green;'>" . $title . "</span>"; ?></div>
                <div class="recipeDocLabel">Ingredients: </div>
                <div class="docContents">
                    <?php echo $ingredients; ?>
                </div>
                <div class="recipeDocLabel">Preparation: </div>
                <div class="docContents">
                    <?php echo $preparation; ?>
                </div>    
            </div><!--end of id="documentContents"-->
        </div><!--end of id="document"-->
        <div id="closeRead" onclick="closeRead()">Close</div>
    </div><!--end of id="documentGrid"-->
</div><!--end of id="documentModal"-->