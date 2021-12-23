<?php
session_start();

if(!isset($_SESSION["userId"])){
    header("location: index.php");
    exit();
}
//make variables of not yet submitted recipe form inputs (so user won't need to start over after finding error)
$tempTitle = $_SESSION["temporaryRecipeTitle"];
$tempIng = $_SESSION["temporaryIngredients"];
$tempPrep = $_SESSION["temporaryPreparation"];
?>

<!DOCTYPE html>
<html>
<head>

    <title>Cookie Dough</title>
    <link rel="stylesheet" href="CSS/user.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body id="bodyID">

<!--=======================NAVBAR==================================================-->
<div id="navbar">
    <div id="headerGrid">
        <div id="userTitle">
            <?php
            echo $_SESSION["username"];
            ?>
        </div><!--end of id="userTitle" -->
        <div id="upperNavGrid">
            <form id="searchBar" action="includes/search2.inc.php" method="POST">
                <label id="searchLabel" for ="search">Search: </label>
                <input id="search" type = "text" name="searchInput" placeholder ="Enter recipe/chef name">
                <button id="searchButton" name="searchButton">Search</button>
            </form><!--end of id="searchBar"-->
            <div class="dropdown">
                <div onclick="dropDownNav()" class="dropbtn">&equiv;</div>
                <div id="myDropdown" class="dropdown-content">
                    <div id="accountBtnDD" class="navOpt" onclick="accountPromptBox()">Account</div>
                    <form id="myRecipesFormDD" class="navOpt" action="includes/getRecipeList.inc.php" method="POST"><button class="navDropBtn" name="myRecipesBtn">My Recipes</button></form>
                    <form id="logoutFormDD" class="navOpt" action="includes/logout.inc.php" method="POST"><button class="navDropBtn" name="logoutBtn">Log Out</button></form>
                </div><!--end of id="myDropdown"-->
            </div><!--end of class="dropdown"-->
        </div><!--end of id="upperNavGrid"-->
        <div id="buttonsGrid">
          <div id="accountBtn" class="homeButtons" onclick="accountPromptBox()">Account</div>
          <form id="myRecipesForm" class="homeButtons" action="includes/getRecipeList.inc.php" method="POST"><button id="myRecipesBtn" name="myRecipesBtn">My Recipes</button></form>
          <form id="logoutForm" action="includes/logout.inc.php" method="POST"><button name="logoutBtn" class="homeButtons">Log Out</button></form>
        </div><!--end of id="buttonsGrid"-->
    </div><!--end of id="headerGrid"-->
</div><!--end of id="navbar"-->

<!--========================CENTRAL PAGE TITLE======================================-->
<div id="centralPageTitle">
    Cookie Dough
</div>

<!--========================PUBLIC RECIPES PROMPT BOX===========================================-->       
<?php
if(isset($_GET["searchResult"])){
    include_once 'searchResultPromptBox2.php';
}
?>

<!--==========================RECIPE DOC 2======================================-->
<?php
if(isset($_GET["recipeDocument"])){
    include_once 'recipeDoc2.php';
}
?>

<!--=======================ACCOUNT===============================================-->
<div id="accountModal">
    <div id="accountContainer">
        <div id="accountSecondaryContainer">
            <div id="accountTitle">Account</div>
            <div id="accountContents">
            <!--edit username section ----------------->
                <form action="includes/editUsername.inc.php" method="POST" >
                    <div class="editUserAcctGrid">
                    <div class="editAcctFieldLabel">username: </div><div id="currentUserName"><?php echo $_SESSION["username"]; ?></div><input id="editedusername" name="editedusername" class="userInput"><div id="editusernamebtn" onclick="editusername()">Edit</div><button id="saveUsernameBtn" name="saveUsernameBtn">Save</button>
                    </div><!--end of username upper half class="editUserAcctGrid"-->
                    <div id="editUNLowerHalf">
                    <div id="uNeditStatusMsg">Please enter password to confirm.</div>
                    <div class="editUserAcctGrid">
                    <div>password: </div><input id="currentPWEditUN" type="password" name="currentPWEditUN" class="userInput">
                    </div><!--end of username lower half class="editUserAcctGrid"-->
                    </div><!--end of id="editUNLowerHalf" -->
                </form>
            <!--edit email section ----------------->
                <form class="editAcctForm" action="includes/editEmail.inc.php" method="POST" >
                    <div class="editUserAcctGrid">
                    <div class="editAcctFieldLabel">email: </div><div id="currentEmail"><?php echo $_SESSION["email"]; ?></div><input id="editedEmail" name="editedEmail" class="userInput"><div id="editEmailBtn" onclick="editEmail()">Edit</div><button id="saveEmailBtn" name="saveEmailBtn">Save</button>
                    </div><!--end of email upper half class="editUserAcctGrid"-->
                    <div id="editEmailLowerHalf">
                    <div id="eMeditStatusMsg">Please enter password to confirm.</div>
                    <div class="editUserAcctGrid">
                    <div>password: </div><input id="currentPWEditEM" type="password" name="currentPWEditEM" class="userInput">
                    </div><!--end of email lower half class="editUserAcctGrid"-->
                    </div><!--end of id="editEmailLowerHalf" -->
                </form>
    
            <!--edit passowrd section--------------->
                <form id ="editPassowrdForm" class="editAcctForm" action="includes/editPassword.inc.php" method="POST">
                    <div class="editUserAcctGrid">
                    <div class="editAcctFieldLabel">password: </div><div id="currentPassword">****</div><div id="editpasswordbtn" onclick="editpassword()">Edit</div><button id="savePasswordBtn" name="savePasswordBtn">Save</button>
                    </div><!--end of password class="editUserAcctGrid"-->
                    
                    <div id="newPasswordContainer">
                    <br>
                    <input id="oldPassword" name="oldPassword" type="password" class="userInput inputSpace" placeholder="Old Password..."><br>
                    <input id="newPassword" name="newPassword" type="password" class="userInput inputSpace" placeholder="New Password..."><br>
                    <input id="reEnteredNewPWD" name="reEnteredNewPWD" type="password" class="userInput inputSpace" placeholder="Confifrm New Password...">
                    <!--<div id="submissionStatusMsg"></div>-->
                    </div><!--end of id="newPasswordContainer"-->
                    
                </form><!--end of id ="editPassowrdForm" -->
            <div id="orNote">OR</div>
    
            <!--delete account section------------------------------------------->
            <div id="deleteAcctSection">
                <div id="deleteAcctGrid">
                    <input id="deleteAccountCheckBox" type="checkbox" onclick="deleteAcct()"><div class="editAcctFieldLabel">Delete Account</div>
                </div><!--end of id="deleteAcctGrid" -->
                <div id="deleteMsgAndConfirmSect">
                    <div>*This will delete all records of this user account. Please enter password to acknowledge this message and submit.</div>
                    <form id="deleteAcctForm" method="POST" action="includes/deleteAcct.inc.php">
                        <input type="password" id="deleteAcctuserPW" name="deleteAcctuserPW" class="userInput inputSpace"><button id="deleteAcctBtn" name="deleteAcctBtn">Delete</button>
                    </form><!--end of id="deleteAcctForm"-->
                </div><!--end of id="deleteMsgAndConfirmSect" -->
            </div><!--end of id="deleteAcctSection" -->
    
            </div><!--end of id="accountContents" -->
            <div id="accountCloseButton" onclick="closeaccount()">Close</div>
        </div><!--end of id="accountSecondaryContainer-->
    </div><!--end of id="accountContainer"-->
</div><!--end of id="accountModal"-->

<!--========================MY RECIPES PROMPT BOX===========================================-->       
<?php
if(isset($_GET["myRecipes"])){
    include_once 'myRecipesPromptBox.php';
}
?>

<!--========================NEW RECIPE PROMPT BOX===========================================-->       

<div id="newRecipeModal">
    <div id="newRecipeContainer">
        <div id="newRecipeSecondaryContainer">
            <form id="newRecipeForm" action="includes/newRecipe.inc.php" method ="POST">
                <div id="newRecipeHeaderGrid">
                    <div id="newRecipeModalBackBtn" onclick="newRecipeModalBackBtn()">&larr;</div><div id="newRecipeFormTitle">New Recipe</div>
                </div><!--end of id="newRecipeHeaderGrid"-->
                <label for="newRecipeTitle" class="newRecipeLabel">Title: </label><input id="newRecipeTitle" type="text" name="newRecipeTitle" value="<?php if(!$tempTitle){echo "";} else if($tempTitle){echo $tempTitle;} ?>">
                <div id="newIngredientsTitle" class="newRecipeLabel">Ingredients:</div>
                <textarea id="newIngredients" class="newRecipeInputs textarea" rows="7" cols="32" name="newIngredients">
                    <?php
                        if(!$tempIng){
                            echo "";
                        }
                        else if($tempIng){
                            echo $tempIng;
                        }
                    ?>
                </textarea>
                <div id="newPreparationTitle" class="newRecipeLabel">Preparation:</div>
                <textarea id="newPreparation" class="newRecipeInputs textarea" rows="8" cols="32" name="newPreparation">
                    <?php

                        if(!$tempPrep){
                            echo "";
                        }
                        else if($tempPrep){
                            echo $tempPrep;
                        }
                        
                    ?>
                </textarea>
                <br>
                <div id="newRecipeBtnsGrid">
                    <div><input type="checkbox" id="makePublic" name="makePublic"><label for="makePublic" class="publicCheckBoxLabel">public</label></div><button id="saveNewRecipe" class="newRecipeBtn" name="saveNewRecipe">Save</button><button id="newRecipeCancelButton" name ="newRecipeCancelButton" class="newRecipeBtn newRecipeBtnDiv">Cancel</button>
                </div><!-- end of id="newRecipeBtnsGrid" -->
            </form><!-- end of id="newRecipeForm" -->
        </div><!--end of id="newRecipeSecondaryContainer-->
    </div><!--end of id="newRecipeContainer"-->
</div><!--end of id="newRecipeModal"-->

<!--========================RECIPE PROMPT BOX===========================================-->       

<?php

    if(isset($_GET["recipe"]) || isset($_GET["recipeBack"])){
        include_once 'recipePromptBox.php';
    }

?>

<!--=======================MESSAGE PROMPT BOX===============================================-->
<?php
    if(isset($_GET["error"])){
        include_once 'messagePrompt.php';
    }
    else if(isset($_GET["success"])){
        include_once 'messagePrompt.php';
    }
?>

<!--========================ALL JAVASCRIPT FUNCTIONS BELOW===========================================-->
<script src="JS/user.js"></script>
<script>
//==========================NAVBAR===================================================//
function dropDownNav() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

</body>
</html>
