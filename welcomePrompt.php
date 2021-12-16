<?php
session_start();
$name = $_SESSION["username"];
?>

<div id="welcomeModal">
    <div id="welcomeContainer">
        <div id="welcomeSecondaryContainer">
            <div id="welcomeTitle">
                <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyInput" || $_GET["error"] == "invalidUsername" || $_GET["error"] == "invalidEmail" || $_GET["error"] == "passwordsDontMatch" || $_GET["error"] == "nameTaken"){
                            echo "Sign Up Error...";
                        }
                        else if ($_GET["error"] == "none"){
                            echo "Welcome". $name . "!";
                        }
                        else if ($_GET["error"] == "emptyLoginInput" || $_GET["error"] == "wrongLogin"){
                            echo "Login Error...";
                        }
                        else if ($_GET["error"] == "noneLoggedOut"){
                            echo "Logged Out...";
                        }
                        else if ($_GET["error"] == "noneAcctDeleted"){
                            echo "Account Deleted";
                        }
                    }
                ?>
            </div>
            <div id="welcomeContents">
            <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyInput" || $_GET["error"] == "emptyLoginInput"){
                            echo "Please fill in all fields.";
                        }
                        else if ($_GET["error"] == "invalidUsername"){
                            echo "Username invalid. Please submit username using only characters a-z, A-Z and/or 0-9.";
                        }
                        else if ($_GET["error"] == "invalidEmail"){
                            echo "Email invalid. Please try again.";
                        }
                        else if ($_GET["error"] == "passwordsDontMatch"){
                            echo "'Password' and 'Confirm Password' fields did not match. Please try again.";
                        }
                        else if ($_GET["error"] == "nameTaken"){
                            echo "Username or email already taken. Please try again to sign up or log in.";
                        }
                        else if ($_GET["error"] == "stmtFailed"){
                            echo "Something went wrong. Please try again.";
                        }
                        else if ($_GET["error"] == "none"){
                            echo "Please log in to access your account.";
                        }
                        else if ($_GET["error"] == "wrongLogin"){
                            echo "Wrong username or password. Please try again.";
                        }
                        else if ($_GET["error"] == "noneLoggedOut"){
                            echo "<span style='font-style: italic;'>See ya later!</span>";
                        }
                        else if ($_GET["error"] == "noneAcctDeleted"){
                            echo "<span style='font-style: italic;'>Goodbye!</span>";
                            session_unset();
                            session_destroy();
                        }
                    }
                ?>
            </div>
            <div id="welcomeCloseButton" onclick="closewelcome()">Ok</div>
        </div><!--end of id="welcomeSecondaryContainer-->
    </div><!--end of id="welcomeContainer"-->
</div><!--end of id="welcomeModal"-->
