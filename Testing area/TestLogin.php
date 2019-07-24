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
            <input type=\"submit\"> or <a href=\"./GenerateCredentials.php\"> Sign Up </a>
        </form>";
        }
                //Check if the credentials have been entered, and also if they were incorrect
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $creds = fopen("users/" . htmlspecialchars($_POST['UName']), "r"); //Open the temporary test file for the user
            $key = chop(fgets($creds)); //Goddamn newlines get read as spaces for whatever reason, so make sure there is no whitespace
            if (hash("sha512", htmlspecialchars($_POST['UName']) . "ZYX" . htmlspecialchars($_POST['PWord']) . "ABC") == $key) { //Encode the data and check if the key matches it
                echo "Login successful!";
            } else {
                loginPrompt(); //The user gotta try again
                echo "<br><br><br>The username or password was incorrect!";
            }
        } else {
            loginPrompt();
        }
        ?>
    </body>
</html>
