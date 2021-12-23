document.getElementById("publicRecipesCloseButton").addEventListener("click", closePublicRecipes);
document.getElementById("closeRead").addEventListener("click", closeRead);
document.getElementById("aboutBtnDD").addEventListener("click", aboutPromptBox);
document.getElementById("aboutBtn").addEventListener("click", aboutPromptBox);
document.getElementById("signUpBtnDD").addEventListener("click", signupPromptBox);
document.getElementById("signUpBtn").addEventListener("click", signupPromptBox);
document.getElementById("loginBtnDD").addEventListener("click", loginPromptBox);
document.getElementById("loginBtn").addEventListener("click", loginPromptBox);
document.getElementById("aboutCloseButton").addEventListener("click", closeabout);
document.getElementById("signupCloseButton").addEventListener("click", closesignup);
document.getElementById("welcomeCloseButton").addEventListener("click", closewelcome);
document.getElementById("loginCloseButton").addEventListener("click", closelogin);

//===============================PUBLIC RECIPES PROMPT BOX==================================
function closePublicRecipes(){
    document.getElementById("publicRecipesModal").style.display="none";
}
//===============================RECIPE DOC 2===========================================//
function closeRead(){
    document.getElementById("documentModal").style.display="none";
}
//==========================ABOUT PROMPT BOX====================================//
//display about prompt box-------------------------------------------------------------
function aboutPromptBox(){
    document.getElementById("aboutModal").style.display ="block";
}//end of aboutPromptBox()

//close about prompt box-------------------------------------------------------------
function closeabout(){
    document.getElementById("aboutModal").style.display ="none";
}//end of closeabout()
//==========================SIGN UP PROMPT BOX===================================//
//display signup prompt box-------------------------------------------------------------
function signupPromptBox(){
    document.getElementById("signupModal").style.display ="block";
    document.getElementById("newUsername").value ="";
    document.getElementById("newPassword").value ="";
    document.getElementById("newUserEmail").value ="";
    document.getElementById("confirmNewPassword").value="";
}//end of signupPromptBox()

//close signup prompt box-------------------------------------------------------------
function closesignup(){
    document.getElementById("signupModal").style.display ="none";
}//end of closesignup()

//==========================WELCOME PROMPT BOX====================================//
//close welcome prompt box-------------------------------------------------------------
function closewelcome(){
    document.getElementById("welcomeModal").style.display ="none";
}//end of closewelcome()

//===========================LOGIN PROMPT BOX====================================//
//display login prompt box-------------------------------------------------------------
function loginPromptBox(){
    document.getElementById("loginModal").style.display ="block";
    document.getElementById("username").value ="";
    document.getElementById("password").value ="";
}//end of loginPromptBox()

//close login prompt box-------------------------------------------------------------
function closelogin(){
    document.getElementById("loginModal").style.display ="none";
}//end of closelogin()
