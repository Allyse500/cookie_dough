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
    <link rel="stylesheet" href="user.css">
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
        <form id="searchBar" action="includes/search2.inc.php" method="POST"><label id="searchLabel" for ="search">Search: </label><input id="search" type = "text" name="searchInput" placeholder ="Enter recipe/chef name"><button id="searchButton" name="searchButton">Search</button></form>
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
    include_once 'searchResultPromptBox.php';
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
<script>

//===============================PUBLIC RECIPES PROMPT BOX==================================
function closePublicRecipes(){
document.getElementById("publicRecipesModal").style.display="none";
}

//==========================ACCOUNT PROMPT BOX====================================//
//display account prompt box-------------------------------------------------------------
function accountPromptBox(){
document.getElementById("accountModal").style.display ="block";
}//end of accountPromptBox()

//close account prompt box-------------------------------------------------------------
function closeaccount(){
document.getElementById("accountModal").style.display ="none";

document.getElementById("editedusername").style.display = "none";
document.getElementById("editusernamebtn").style.display = "block";
document.getElementById("currentUserName").style.display ="block";
document.getElementById("saveUsernameBtn").style.display = "none";
document.getElementById("editUNLowerHalf").style.display = "none";

document.getElementById("editedEmail").style.display = "none";
document.getElementById("editEmailBtn").style.display = "block";
document.getElementById("currentEmail").style.display ="block";
document.getElementById("saveEmailBtn").style.display = "none";
document.getElementById("editEmailLowerHalf").style.display = "none";

document.getElementById("newPasswordContainer").style.display ="none";
document.getElementById("savePasswordBtn").style.display="none";
document.getElementById("editpasswordbtn").style.display="block";

document.getElementById("deleteAccountCheckBox").checked = false;
document.getElementById("deleteMsgAndConfirmSect").style.display="none";
}//end of closeaccount()

//display to edit username--------------------------
function editusername(){
var currentUserName = document.getElementById("currentUserName").innerText;

document.getElementById("editusernamebtn").style.display = "none";
document.getElementById("currentUserName").style.display ="none";
document.getElementById("saveUsernameBtn").style.display = "block";
document.getElementById("editedusername").style.display = "block";
document.getElementById("editedusername").value = currentUserName;
document.getElementById("currentPWEditUN").value = "";
document.getElementById("editUNLowerHalf").style.display = "block";

document.getElementById("editedEmail").style.display = "none";
document.getElementById("editEmailBtn").style.display = "block";
document.getElementById("currentEmail").style.display ="block";
document.getElementById("saveEmailBtn").style.display = "none";
document.getElementById("editEmailLowerHalf").style.display = "none";

document.getElementById("newPasswordContainer").style.display ="none";
document.getElementById("savePasswordBtn").style.display="none";
document.getElementById("editpasswordbtn").style.display="block";

document.getElementById("deleteAccountCheckBox").checked = false;
document.getElementById("deleteMsgAndConfirmSect").style.display="none";

}//end of editusername()

//display to edit email--------------------------
function editEmail(){
var currentEmail = document.getElementById("currentEmail").innerText;

document.getElementById("editEmailBtn").style.display = "none";
document.getElementById("currentEmail").style.display ="none";
document.getElementById("saveEmailBtn").style.display = "block";
document.getElementById("editedEmail").style.display = "block";
document.getElementById("editedEmail").value = currentEmail;
document.getElementById("currentPWEditEM").value = "";
document.getElementById("editEmailLowerHalf").style.display = "block";

document.getElementById("editedusername").style.display = "none";
document.getElementById("editusernamebtn").style.display = "block";
document.getElementById("currentUserName").style.display ="block";
document.getElementById("saveUsernameBtn").style.display = "none";
document.getElementById("editUNLowerHalf").style.display = "none";

document.getElementById("newPasswordContainer").style.display ="none";
document.getElementById("savePasswordBtn").style.display="none";
document.getElementById("editpasswordbtn").style.display="block";

document.getElementById("deleteAccountCheckBox").checked = false;
document.getElementById("deleteMsgAndConfirmSect").style.display="none";

}//end of editEmail()


//display to edit password---------------------------
function editpassword(){
document.getElementById("editpasswordbtn").style.display ="none";
document.getElementById("savePasswordBtn").style.display ="block";
document.getElementById("newPasswordContainer").style.display ="block";
document.getElementById("oldPassword").value ="";
document.getElementById("newPassword").value ="";
document.getElementById("reEnteredNewPWD").value ="";

document.getElementById("editedusername").style.display = "none";
document.getElementById("editusernamebtn").style.display = "block";
document.getElementById("currentUserName").style.display ="block";
document.getElementById("saveUsernameBtn").style.display = "none";
document.getElementById("editUNLowerHalf").style.display = "none";

document.getElementById("editedEmail").style.display = "none";
document.getElementById("editEmailBtn").style.display = "block";
document.getElementById("currentEmail").style.display ="block";
document.getElementById("saveEmailBtn").style.display = "none";
document.getElementById("editEmailLowerHalf").style.display = "none";

document.getElementById("deleteAccountCheckBox").checked = false;
document.getElementById("deleteMsgAndConfirmSect").style.display="none";
}//end of editpassword()

function deleteAcct(){
var check = document.getElementById("deleteAccountCheckBox").checked;

if(check == true){
document.getElementById("deleteMsgAndConfirmSect").style.display="block";
document.getElementById("deleteAcctuserPW").value ="";

document.getElementById("editedusername").style.display = "none";
document.getElementById("editusernamebtn").style.display = "block";
document.getElementById("currentUserName").style.display ="block";
document.getElementById("saveUsernameBtn").style.display = "none";
document.getElementById("editUNLowerHalf").style.display = "none";

document.getElementById("editedEmail").style.display = "none";
document.getElementById("editEmailBtn").style.display = "block";
document.getElementById("currentEmail").style.display ="block";
document.getElementById("saveEmailBtn").style.display = "none";
document.getElementById("editEmailLowerHalf").style.display = "none";

document.getElementById("editpasswordbtn").style.display ="block";
document.getElementById("savePasswordBtn").style.display ="none";
document.getElementById("newPasswordContainer").style.display ="none";
}
else{
document.getElementById("deleteMsgAndConfirmSect").style.display="none";}
}//end of deleteAcct()

//==========================MY RECIPES PROMPT BOX===================================//
//display myRecipes prompt box-------------------------------------------------------------
function myRecipesPromptBox(){
document.getElementById("myRecipesModal").style.display ="block";
}//end of myRecipesPromptBox()

//close myRecipes prompt box-------------------------------------------------------------
function closemyRecipes(){
document.getElementById("myRecipesModal").style.display ="none";
}//end of closemyRecipes()

//========================NEW RECIPE PROMPT BOX===========================================//      
//display new recipe form--------------------------------------------------------------------
function newRecipe(){
document.getElementById("newRecipeModal").style.display = "block";
document.getElementById("myRecipesModal").style.display ="none";
}//end of newRecipe()

//return to My Recipies prompt box, leave this function to enable users to reference other recipies while buliding the one they want----------------------------------------
function newRecipeModalBackBtn(){
    document.getElementById("newRecipeModal").style.display = "none";
    document.getElementById("myRecipesModal").style.display ="block";  
}

//========================RECIPE PROMPT BOX===========================================//      
//display delete recipe confirmation prompt box--------------------------
function drcModal(){
    document.getElementById("recipeModal").style.display ="none";
    document.getElementById("drcModal").style.display ="block";
}
//cancel delete request by returning to recipe prompt box----------------
function canceldrc(){
    document.getElementById("recipeModal").style.display ="block";
    document.getElementById("drcModal").style.display ="none";
}

//==========================MESSAGE PROMPT BOX====================================//
//close message prompt box-------------------------------------------------------------
function closeMessage(){
document.getElementById("messageModal").style.display ="none";
}//end of closeMessage()

function returnToNewRecipePrompt(){
document.getElementById("messageModal").style.display ="none";
document.getElementById("newRecipeModal").style.display ="block";

}
</script>

</body>
</html>
