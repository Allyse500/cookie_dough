document.getElementById("publicRecipesCloseButton").addEventListener("click", closePublicRecipes);
document.getElementById("closeRead").addEventListener("click", closeRead);
document.getElementById("accountBtnDD").addEventListener("click", accountPromptBox);
document.getElementById("accountBtn").addEventListener("click", accountPromptBox);
document.getElementById("accountCloseButton").addEventListener("click", closeaccount);
document.getElementById("editusernamebtn").addEventListener("click", editusername);
document.getElementById("editEmailBtn").addEventListener("click", editEmail);
document.getElementById("editpasswordbtn").addEventListener("click", editpassword);
document.getElementById("deleteAccountCheckBox").addEventListener("click", deleteAcct);
document.getElementById("myRecipesCloseButton").addEventListener("click", closemyRecipes);
document.getElementById("newRecipe").addEventListener("click", newRecipe);
document.getElementById("newRecipeModalBackBtn").addEventListener("click", newRecipeModalBackBtn);
document.getElementById("delRecipe").addEventListener("click", drcModal);
document.getElementById("drcCancelButton").addEventListener("click", canceldrc);
document.getElementById("messageCloseButton").addEventListener("click", closeMessage);
document.getElementById("messageCloseButton2").addEventListener("click", returnToNewRecipePrompt);

//===============================PUBLIC RECIPES PROMPT BOX==================================
function closePublicRecipes(){
    document.getElementById("publicRecipesModal").style.display="none";
}

//===============================RECIPE DOC 2===========================================//
function closeRead(){
    document.getElementById("documentModal").style.display="none";
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
    document.getElementById("deleteMsgAndConfirmSect").style.display="none";
    }
}//end of deleteAcct()

//==========================MY RECIPES PROMPT BOX===================================//
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
