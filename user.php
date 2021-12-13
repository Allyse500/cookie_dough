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
        <div id="userTitle">Kim</div>
        <div id="searchBar"><label id="searchLabel" for ="search">Search: </label><input id="search" type = "text" name="search" placeholder ="Enter cookie name"><button id="searchButton">Search</button></div>
        <div id="buttonsGrid">
          <div id="accountBtn" class="homeButtons" onclick="accountPromptBox()">Account</div>
          <div id="myRecipesBtn" class="homeButtons" onclick="myRecipesPromptBox()">My Recipes</div>
          <form id="loginForm" action="/logout" method="POST"><button name="logoutBtn" class="homeButtons">Log Out</button></form>
        </div><!--end of id="buttonsGrid"-->
    </div><!--end of id="headerGrid"-->
</div><!--end of id="navbar"-->

<!--========================CENTRAL PAGE TITLE======================================-->
<div id="centralPageTitle">
    Cookie Dough
</div>
<!--=======================ACCOUNT===============================================-->
<div id="accountModal">
    <div id="accountContainer">
        <div id="accountSecondaryContainer">
            <div id="accountTitle">Account</div>
            <div id="accountContents">
            <!--edit username section ----------------->
                <form action="/editUsername" method="POST" >
                    <div class="editUserAcctGrid">
                    <div class="editAcctFieldLabel">username: </div><div id="currentUserName"><%= name %></div><input id="editedusername" name="editedusername" class="userInput"><div id="editusernamebtn" onclick="editusername()">Edit</div><button id="saveUsernameBtn">Save</button>
                    </div><!--end of username upper half class="editUserAcctGrid"-->
                    <div id="editUNLowerHalf">
                    <div id="uNeditStatusMsg">Please enter password to confirm.</div>
                    <div class="editUserAcctGrid">
                    <div>password: </div><input id="currentPWEditUN" type="password" name="currentPWEditUN" class="userInput">
                    </div><!--end of username lower half class="editUserAcctGrid"-->
                    </div><!--end of id="editUNLowerHalf" -->
                </form>
            <!--edit email section ----------------->
                <form class="editAcctForm" action="/editEmail" method="POST" >
                    <div class="editUserAcctGrid">
                    <div class="editAcctFieldLabel">email: </div><div id="currentEmail"><%= email %></div><input id="editedEmail" name="editedEmail" class="userInput"><div id="editEmailBtn" onclick="editEmail()">Edit</div><button id="saveEmailBtn">Save</button>
                    </div><!--end of email upper half class="editUserAcctGrid"-->
                    <div id="editEmailLowerHalf">
                    <div id="eMeditStatusMsg">Please enter password to confirm.</div>
                    <div class="editUserAcctGrid">
                    <div>password: </div><input id="currentPWEditEM" type="password" name="currentPWEditEM" class="userInput">
                    </div><!--end of email lower half class="editUserAcctGrid"-->
                    </div><!--end of id="editEmailLowerHalf" -->
                </form>
    
            <!--edit passowrd section--------------->
                <form id ="editPassowrdForm" class="editAcctForm" action="/editPassword" method="POST">
                    <div class="editUserAcctGrid">
                    <div class="editAcctFieldLabel">password: </div><div id="currentPassword">****</div><div id="editpasswordbtn" onclick="editpassword()">Edit</div><button id="savePasswordBtn">Save</button>
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
                    <form id="deleteAcctForm" method="POST" action="/deleteAcct">
                        <input type="password" id="deleteAcctuserPW" name="deleteAcctuserPW" class="userInput inputSpace"><button id="deleteAcctBtn">Delete</button>
                    </form><!--end of id="deleteAcctForm"-->
                </div><!--end of id="deleteMsgAndConfirmSect" -->
            </div><!--end of id="deleteAcctSection" -->
    
            </div><!--end of id="accountContents" -->
            <div id="accountCloseButton" onclick="closeaccount()">Close</div>
        </div><!--end of id="accountSecondaryContainer-->
    </div><!--end of id="accountContainer"-->
</div><!--end of id="accountModal"-->

<!--========================MY RECIPES PROMPT BOX===========================================-->       

<div id="myRecipesModal">
    <div id="myRecipesListContainer">
        <div id="myRecipesListSecondaryContainer">
            <div id="myRecipesListTitle">My Recipes</div>
            <div id="myRecipesList">
                <div id="numLoggedRecipesMsg">No logged recipes.</div>
                <div id="myRecipesInputContents"></div><!--end of id="myRecipesInputContents", empty array of recipes -->
                <br>
                <div id="myRecipesBtnsGrid">
                    <div id="newRecipeForm"><button id="newRecipe" name="newRecipe" onclick="newRecipe()">New</button></div><div id="myRecipesCloseButton" onclick="closemyRecipes()">Close</div>
                </div><!-- end of id="myRecipesBtnsGrid" -->
            </div><!--end of id="myRecipesList"-->
        </div><!--end of id="myRecipesListSecondaryContainer-->
    </div><!--end of id="myRecipesListContainer"-->
</div><!--end of id="myRecipesModal"-->

<!--========================RECIPE PROMPT BOX===========================================-->       

<div id="recipeModal">
    <div id="recipeContainer">
        <div id="recipeSecondaryContainer">
            <label for="recipeTitle">Title: </label><input id="recipeTitle">
            <div id="ingredientsTitle">Ingredients:</div>
            <textarea id="ingredients" rows="3" cols="4"></textarea>
            <div id="preparationTitle">Preparation:</div>
            <textarea id="ingredients" rows="3" cols="4"></textarea>
            <br>
            <div id="recipeBtnsGrid">
                <div id="delRecipe">Delete</div><div id="saveRecipeForm"><button id="saveRecipe" name="saveRecipe" onclick="saveRecipe()">Save</button></div><div id="recipeCloseButton" onclick="closerecipe()">Close</div>
            </div><!-- end of id="recipeBtnsGrid" -->
        </div><!--end of id="recipeSecondaryContainer-->
    </div><!--end of id="recipeContainer"-->
</div><!--end of id="recipeModal"-->



<!--========================ALL JAVASCRIPT FUNCTIONS BELOW===========================================-->
<script>
        
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

//display recipe form--------------------------------------------------------------------
function newRecipe(){
document.getElementById("recipeModal").style.display = "block";
document.getElementById("myRecipesModal").style.display ="none";
}//end of newRecipe()

//close recipe form----------------------------------------------------------------------
function closerecipe(){
document.getElementById("recipeModal").style.display = "none";
}
</script>

</body>
</html>
