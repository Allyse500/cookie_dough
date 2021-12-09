<!DOCTYPE html>
<html>
<head>

    <title>Cookie Dough</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body id="bodyID">

<!--=======================NAVBAR==================================================-->
<div id="navbar">
    <div id="headerGrid">
        <div id="homeBtn">Home</div><div id="searchBar"><label id="searchLabel" for ="search">Search: </label><input id="search" type = "text" name="search" placeholder ="Enter cookie name"><button id="searchButton">Search</button></div><div id="buttonsGrid"><div id="aboutBtn" class="homeButtons" onclick="aboutPromptBox()">About</div><div id="signUpBtn" class="homeButtons" onclick="signupPromptBox()">Sign Up</div><div id="loginBtn" class="homeButtons" onclick="loginPromptBox()">Log In</div></div><!--end of id="buttonsGrid"-->
    </div><!--end of id="headerGrid"-->
</div><!--end of id="navbar"-->

<!--========================CENTRAL PAGE TITLE======================================-->
<div id="centralPageTitle">
    Cookie Dough
</div>
<!--=======================ABOUT===============================================-->
<div id="aboutModal">
    <div id="aboutContainer">
        <div id="aboutSecondaryContainer">
            <div id="aboutTitle">About</div>
            <div id="aboutContents">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: orange; font-weight: bold; font-style: italic;">Cookie Dough</span> provides its users with the ability to search cookie recipes as well as save recipes of their own. This service is currently free to the public.<br><br> Enjoy!<br><br><span style="font-style: italic">-Admin (Allyse D. Johnson)</span>
            </div>
            <div id="aboutCloseButton" onclick="closeabout()">Close</div>
        </div><!--end of id="aboutSecondaryContainer-->
    </div><!--end of id="aboutContainer"-->
</div><!--end of id="aboutModal"-->

<!--========================SIGN UP PROMPT BOX===========================================-->       

<div id="signupModal">
    <div id="signupFormContainer">
        <div id="signupFormSecondaryContainer">
            <div id="signupFormTitle">Sign Up</div>
            <form id="signupForm" action ="/sign_up" method="POST">
                <div id="signupInputContents">
                    <label for="newUsername" class="signupFormLabel">Username: </label>
                    <input class="formInput" type="text" id="newUsername" name="newUsername"><br>
                    <div id="signupPasswordBlock">
                        <label for="newPassword" class="signupFormLabel">Password: </label>
                        <input class="formInput" type="password" id="newPassword" name="newPassword">
                    </div><!--end of id="signupPasswordBlock"-->
                </div><!--end of id="signupInputContents" -->
                <br>
                <div id="signupBtnsGrid">
                    <button id="signupSubmitBtn">Submit</button><div id="signupCloseButton" onclick="closesignup()">Close</div>
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
                    <form id="loginForm" action="/login" method="POST">
                        <div id="loginInputContents">
                            <label for="username" class="loginFormLabel">Username: </label>
                            <input class="formInput" type="text" id="username" name="username"><br>
                            <div id="loginPasswordBlock">
                                <label for="password" class="loginFormLabel">Password: </label>
                                <input class="formInput" type="password" id="password" name="password">
                            </div><!--end of id="loginPasswordBlock"-->
                        </div><!--end of id="loginInputContents" -->
                        <br>
                        <div id="loginBtnsGrid">
                            <button id="loginSubmitBtn">Submit</button><div id="loginCloseButton" onclick="closelogin()">Close</div>
                        </div><!--end of id="loginBtnsGrid"-->
                    </form><!--end of id="loginForm"-->
                </div><!--end of id="loginFormSecondaryContainer-->
            </div><!--end of id="loginFormContainer"-->
        </div><!--end of id="loginModal"-->

<!--========================ALL JAVASCRIPT FUNCTIONS BELOW===========================================-->
        <script>
        
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


        // function signUpForm(){
        // document.getElementById("loginModal").style.display ="none";
        // document.getElementById("signUpModal").style.display ="block";
        // }
        
        // function loginForm(){
        // document.getElementById("loginModal").style.display ="block";
        // document.getElementById("signUpModal").style.display ="none";
        // }
        
        /*function signUpTextResponce(){
        document.getElementById("signUpTextResponce").style.display ="block";
        }
        
        function loginTextResponce(){
        document.getElementById("loginTextResponce").style.display ="block";
        }*/
        </script>

</body>
</html>
