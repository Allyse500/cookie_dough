<?php
session_start();
$name = $_SESSION["username"];
$email = $_SESSION["email"];
?>
<div id="messageModal">
    <div id="messageContainer">
        <div id="messageSecondaryContainer">
            <div id="messageTitle">
                <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyInput" || $_GET["error"] == "invalidUsername" || $_GET["error"] == "invalidEmail" || $_GET["error"] == "passwordsDontMatch" || $_GET["error"] == "nameTaken" || $_GET["error"] == "notUptated" || $_GET["error"] == "emailTaken"){
                            echo "Error...";
                        }
                        else if ($_GET["error"] == "noneEditUN" || $_GET["error"] =="noneEditEM" || $_GET["error"] == "noneEditPW"){
                            echo "Success!";
                        }
                        else if ($_GET["error"] == "sameUsername" || $_GET["error"] == "sameEmail"){
                            echo "No change...";
                        }
                        // else if ($_GET["error"] == "emptyLoginInput" || $_GET["error"] == "wrongLogin"){
                        //     echo "Login Error...";
                        // }
                    }
                ?>
            </div>
            <div id="messageContents">
            <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyInput"){
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
                            echo "Username already taken. Please try again.";
                        }
                        else if ($_GET["error"] == "stmtFailed"|| $_GET["error"] == "notUptated"){
                            echo "Something went wrong. Please try again.";
                        }
                        else if ($_GET["error"] == "noneEditUN"){
                            echo "Updated username to ". $name . "!";
                        }
                        else if ($_GET["error"] == "wrongPW"){
                            echo "Password incorrect. Please try again.";
                        }
                        else if ($_GET["error"] == "sameUsername"){
                            echo "Username requested is the same as the current username.";
                        }
                        else if ($_GET["error"] == "sameEmail"){
                            echo "Email requested is the same as the current email.";
                        }
                        else if ($_GET["error"] == "noneEditEM"){
                            echo "Updated email to ". $email . "!";
                        }
                        else if ($_GET["error"] == "emailTaken"){
                            echo "Email already taken. Please try again.";
                        }
                        else if ($_GET["error"] == "noneEditPW"){
                            echo "Password updated!";
                        }
                    }
                ?>
            </div>
            <div id="messageCloseButton" onclick="closeMessage()">Ok</div>
        </div><!--end of id="messageSecondaryContainer-->
    </div><!--end of id="messageContainer"-->
</div><!--end of id="messageModal"-->
