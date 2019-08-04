<?php
session_start();

$debug = 1; // Echo keys etc etc, and destroys the session when revisiting
if ($debug == 1) {
    if ($_SESSION['active']) {
        header("Location: https://ccs.geekrunner.net/CCS/index.php");
    }
    session_destroy();
}

$usr = $_POST["usr"];
$pwd = $_POST["pwd"];
if (!empty($usr) xor ! empty($pwd)) {
    if (empty($usr) && empty($pwd)) {
        $message = "&nbsp;";
    } else if (empty($usr)) {
        $message = "Username is missing";
    } else {
        $message = "Password is missing";
    }
} else {

    if (strlen(htmlspecialchars(stripslashes($_POST["usr"]))) > 0) { //Sanity check to enable easter egg
        $usr = htmlspecialchars(stripslashes($_POST["usr"])); //Make sure we don't get 1337 h4x0r'd on.
        $nousr = 0;
    } else {
        $usr = ""; //Memes
        $nousr = 0;
    }
    if (strlen(htmlspecialchars(stripslashes($_POST["pwd"]))) > 0) {
        $pwd = htmlspecialchars(stripslashes($_POST["pwd"]));
        $nopwd = 0;
    } else {
        $pwd = "";
        $nopwd = 0; //Memes 2: I went too far
    }
    if (!$nousr && !$nopwd) {
        require 'admin/includes/dbconnect.inc';
        $query = "SELECT `Password Token` FROM Users WHERE `Username`='" . $usr . "'";
        $key = mysqli_fetch_array(mysqli_query($conn, $query));
        if ($debug) {
            echo mysqli_info($conn);
        }
        $conn->close();
    }
    $userkey = hash("sha512", $usr . "ZYX" . $pwd . "ABC");
    $active = $_SESSION['active'];
    if ($debug) {
        echo "Key State: " . $key . "<br>";
        echo "Key: " . $key["Password Token"] . "<br>";
        echo "User Key: " . $userkey . "<br>";
        echo "Session State: " . @$_SESSION['active'] . "<br>";
        echo "User: " . $usr . "<br>";
        echo "Pwd: " . $pwd . "<br>";
        debug_print_backtrace();
    }
    if (!empty($active)) {
        if ($active >= "1") {
            header("Location: index.php");
            exit();
        } else if ($active == "0") {
            if (!$nousr && !$nopwd) {
                if ($userkey == $key["Password Token"]) {
                    $_SESSION['active'] = "1";
                    $_SESSION['key'] = $key["Password Token"];
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "<span class='message'>The username or password was incorrect</span>";
                }
            } else {
                $message = "<span class='message'>You went to great lengths to not input your " . (!$nousr ? "password" : "username") . "</span>";
            }
        }
    } else {
        if (empty($_SESSION['usr']) && empty($_SESSION['pwd'])) {
            $message = "&nbsp;";
        } else {
            if (!$nousr && !$nopwd) {
                if ($userkey == $key["Password Token"]) {
                    $_SESSION['active'] = "1";
                    $_SESSION['key'] = $key["Password Token"];
                    header("Location: index.php");
                    exit();
                } else {
                    $message = "<span class='message'>The username or password was incorrect</span>";
                }
            } else {
                $message = "<span class='message'>You went to great lengths to not input your " . (!$nousr ? "password" : "username") . "</span>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Clinical Coder v0.1</title>
        <meta name="description" content="This website exists as a proof of concept for an Automated Clinical Coding System">
        <meta name="keywords" content="clinical coding system, proof of concept">
        <meta name="author" content="Brendan, Callum, Jess, Joe, Michael, Won">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="css/baseStyle.css">
        <link href="https://fonts.googleapis.com/css?family=Heebo:300&display=swap" rel="stylesheet">
        <style type="text/css">
            html, body {
                height:100%;}
            header {
                position:absolute;
                width:100%;
                height:40px;
                text-align:center;
                line-height:40px;
                font-weight:bold;
                color:#444;
                background-color:#eee;
                z-index:2;
            }
            main {
                display:table;
                position:absolute;
                left:0;
                height:100%;
                width:100%;
            }
            main form {
                margin-left:auto;
                margin-right:auto;
                width:275px;
                text-align:center;
            }
            #topBorder {
                background-color:#fafafa;
                border:1px solid #bbb;
                border-bottom:0px;
                border-radius:15px 15px 0px 0px;
            }
            #inner {
                display:table-cell; vertical-align:middle
            }
            #bottomBorder {
                line-height:35px;
                border:1px solid #bbb;
                border-radius:0px 0px 15px 15px;
            }
            .field {
                width:200px;
                height:23px;
                border:1px solid #aaa;
                border-radius:3px;
            }
            #space {
                line-height:15px;
            }
        </style>
    </head>
    <body>
        <header>
            Clinical Coder v0.1
        </header>
        <main>
            <div id="inner">
                <form action="login.php" method="POST">
                    <div id="topBorder">
                        <div id="space">&nbsp;</div>
                        <div id="formTitle">
                            Please Sign In<br>
                        </div>
                        <div id="tiny">Please sign in using your [Health Department]<br>credentials to access this system.</div>
                        <br>
                        <div id="leftAlignBlock">
                            <label for="username">Username:</label><br>
                            <input class="field" name="usr" type="text" max="25" required autofocus>
                            <div id="space">&nbsp;</div>
                            <label for="password">Password:</label><br>
                            <input class="field" name="pwd" type="password" max="50" required>
                        </div>
                        <br><?php echo $message; ?><br><br>
                    </div>
                    <div id="bottomBorder">
                        <input class="button" type="reset" value="Reset">
                        <input class="button" name="login" type="submit" value="Login">
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>
