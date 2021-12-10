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
          <div id="signUpBtn" class="homeButtons" onclick="signupPromptBox()">My Recipes</div>
          <div id="loginBtn" class="homeButtons" onclick="loginPromptBox()">Log Out</div>
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

<!--========================SIGN UP PROMPT BOX===========================================-->       

<div id="signupModal">
    <div id="signupFormContainer">
        <div id="signupFormSecondaryContainer">
            <div id="signupFormTitle">Sign Up</div>
            <form id="signupForm" action ="includes/sign_up.inc.php" method="POST">
                <div id="signupInputContents">
                  <input class="userInput inputSpace" type="text" id="newUsername" name="newUsername" placeholder ="Username..."><br>
                  <input class="userInput inputSpace" type="email" id="newUserEmail" name="newUserEmail" placeholder ="Email..."><br>
                  <input class="userInput inputSpace" type="password" id="newPassword" name="newPassword" placeholder="Password..."><br>
                  <input class="userInput inputSpace" type="password" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password...">
                </div><!--end of id="signupInputContents" -->
                <br>
                <div id="signupBtnsGrid">
                    <button id="signupSubmitBtn" name = "submitSignUp">Submit</button><div id="signupCloseButton" onclick="closesignup()">Close</div>
                </div><!--end of id="signupBtnsGrid"-->
            </form><!--end of id="signupForm"-->
        </div><!--end of id="signupFormSecondaryContainer-->
    </div><!--end of id="signupFormContainer"-->
</div><!--end of id="signupModal"-->

<!--========================LOGIN PROMPT BOX===========================================-->

        <div id="loginModal">
            <div id="loginFormContainer">
                <div id="loginFormSecondaryContainer">
                    <div id="loginFormTitle">Login</div>
                    <form id="loginForm" action="includes/login.inc.php" method="POST">
                        <div id="loginInputContents">
                            <input class="userInput inputSpace" type="text" id="username" name="username" placeholder ="Email or Username..."><br>
                            <input class="userInput inputSpace" type="password" id="password" name="pwd" placeholder="Password...">
                        </div><!--end of id="loginInputContents" -->
                        <br>
                        <div id="loginBtnsGrid">
                            <button id="loginSubmitBtn" name="loginSubmit">Submit</button><div id="loginCloseButton" onclick="closelogin()">Close</div>
                        </div><!--end of id="loginBtnsGrid"-->
                    </form><!--end of id="loginForm"-->
                </div><!--end of id="loginFormSecondaryContainer-->
            </div><!--end of id="loginFormContainer"-->
        </div><!--end of id="loginModal"-->

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
       
</script>

</body>
</html>
