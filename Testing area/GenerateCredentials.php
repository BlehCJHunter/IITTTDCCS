<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
                //Just to show the login boxes
        function loginPrompt() {
            echo "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER['PHP_SELF']) . "\">
            Username: <input type=\"text\" name=\"UName\"><br>
            Password: <input type=\"password\" name=\"PWord\"><br>
            <input type=\"submit\">
        </form>";
        }
                //Check to see if the data has been entered, and if so, make a user, otherwise show the login boxes
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $creds = fopen("users/" . htmlspecialchars($_POST['UName']), "w"); //Temporary test solution: Make a file with a username to store the token
            fwrite($creds, hash("sha512", htmlspecialchars($_POST['UName']) . "ZYX" . htmlspecialchars($_POST['PWord']) . "ABC")); //Store that token
        } else {
            loginPrompt();
        }
        ?>
</html>
