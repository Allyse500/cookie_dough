<?php
session_start();

if(isset($_SESSION["userId"])){
    header("location: user.php");//disable user from getting back to home page
    exit();
}

$recipeSearchResult = $_SESSION["recipeSearchArray"];
?>

<!DOCTYPE html>
<html>
<head>

    <title>Cookie Dough</title>
    <link rel="stylesheet" href="CSS/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body id="bodyID">

<!--=======================NAVBAR==================================================-->
<div id="navbar">
    <div id="headerGrid">
        <div id="homeTitle">Home</div>
        <form id="searchBar" action="includes/search.inc.php" method="POST">
            <label id="searchLabel" for ="search">Search: </label>
            <input id="search" type = "text" name="searchInput" placeholder ="Enter recipe/chef name">
            <button id="searchButton" name="searchButton">Search</button>
            <div class="dropdown">
                <div onclick="dropDownNav()" class="dropbtn">&equiv;</div>
                <div id="myDropdown" class="dropdown-content">
                    <div id="aboutBtnDD" class="navOpt" onclick="aboutPromptBox()">About</div>
                    <div id="signUpBtnDD" class="navOpt" onclick="signupPromptBox()">Sign Up</div>
                    <div id="loginBtnDD" class="navOpt" onclick="loginPromptBox()">Log In</div>
                </div><!--end of id="myDropdown"-->
            </div><!--end of class="dropdown"-->
        </form><!--end of id="searchBar"-->
        <div id="buttonsGrid">
          <div id="aboutBtn" class="homeButtons" onclick="aboutPromptBox()">About</div>
          <div id="signUpBtn" class="homeButtons" onclick="signupPromptBox()">Sign Up</div>
          <div id="loginBtn" class="homeButtons" onclick="loginPromptBox()">Log In</div>
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

<!--==========================RECIPE DOC 2======================================-->
<?php
if(isset($_GET["recipeDocument"])){
    include_once 'recipeDoc.php';
}
?>

<!--=======================ABOUT===============================================-->
<div id="aboutModal">
    <div id="aboutContainer">
        <div id="aboutSecondaryContainer">
            <div id="aboutTitle">About</div>
            <div id="aboutContents">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: orange; font-weight: bold; font-style: italic;">Cookie Dough</span> provides its users with the ability to search public recipes as well as save recipes of their own. This service is currently free to the public.<br><br> Enjoy!<br><br><span style="font-style: italic">-Admin (Allyse D. Johnson)</span>
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

<!--=======================WELCOME PROMPT BOX===============================================-->
<?php
    if(isset($_GET["error"])){
        include_once 'welcomePrompt.php';
    }
    else if(isset($_GET["success"])){
        include_once 'welcomePrompt.php';
    }
?>
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
<script src="JS/index.js"></script>
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
