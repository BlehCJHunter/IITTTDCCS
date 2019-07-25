<?php
session_start();
$conn = @mysqli_connect(/* User Database details */);
if (mysqli_connect_errno()) {
    echo "<br><br>Failed to connect to MySQL: " . mysqli_connect_error();
    echo "<br>During local testing, this is not an error. Once I co-ordinate with the database team, I will remove the error contol operator and this will be a real error.";
    echo "<br>Debug username: 'test'; Debug password: 'test1234'";
    $debug = 1;
}
if (!strlen(@$_POST["usr"]) < 2) { //Sanity check to enable easter egg
    $usr = htmlspecialchars(stripslashes(@$_POST["usr"])); //Make sure we don't get 1337 h4x0r'd on.
} else {
    $usr = htmlspecialchars(stripslashes(@$_POST["pain_is_weakness"])); //Memes
}
if(!strlen(@$_POST["pwd"]) < 8){
        $pwd = htmlspecialchars(stripslashes(@$_POST["pwd"])); //These are expected to not exist at first
} else{
        $pwd = htmlspecialchars(stripslashes(@$_POST["leaving_the_body"])); //Memes 2: I went too far
}
$key = $debug ? hash("sha512", "test" . "ZYX" . "test1234" . "ABC") : mysqli_store_result(mysqli_query($conn, /* "SQL Query to look for the token associated with $usr" */));
if (!$debug) {
    mysqli_close($conn);
}
$active = @$_SESSION['active'];
if (!empty($active)) {
    if ($active >= "1") {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    } else if ($active == "0") {
        if (!empty($usr) && !empty($pwd)) {
            if (hash("sha512", $usr . "ZYX" . $pwd . "ABC") == $key) {
                $_SESSION['active'] = "1";
                header("Location: index.php");
                exit();
            } else {
                $message = "<span style='color:red'>The username or password was incorrect</span>";
            }
        } else {
            $message = "<span style='color:red'>You went to great lengths to not input your " . (!empty($usr) ? "password" : "username") . "</span>";
        }
    }
} else {
    if (empty($usr) && empty($pwd)) {
        $message = "&nbsp;";
    } else {
        if (!empty($usr) && !empty($pwd)) {
            if (hash("sha512", $usr . "ZYX" . $pwd . "ABC") == $key) {
                $_SESSION['active'] = "1";
                header("Location: index.php");
                exit();
            } else {
                $message = "<span style='color:red'>The username or password was incorrect</span>";
            }
        } else {
            $message = "<span style='color:red'>You went to great lengths to not input your " . (!empty($usr) ? "password" : "username") . "</span>";
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
        <link href="https://fonts.googleapis.com/css?family=Heebo:300&display=swap" rel="stylesheet"> 
        <style type="text/css">
            <!--
            html, body	{height:100%; font-family: 'Heebo', sans-serif;}
            main		{display:table; position:absolute; top:0; left:0; height:100%; width:100%;}
            #topBar		{position:absolute; width:100%; height:40px; text-align:center; line-height:40px; font-weight:bold; color:#444; background-color:#eee; z-index:2}
            #inner		{display:table-cell; vertical-align:middle}
            main form	{margin-left:auto; margin-right:auto; width:275px; text-align:center; color:#666;}
            #topBorder, #bottomBorder	{width:275px;}
            #topBorder	{background-color:#fafafa; border:1px solid #bbb; border-bottom:0px; border-radius:15px 15px 0px 0px;}
            #bottomBorder	{line-height:35px; border:1px solid #bbb; border-radius:0px 0px 15px 15px;}
            #formTitle	{font-size:1.1em; font-weight:bold;}
            .field		{width:200px; height:23px; border:1px solid #aaa; border-radius:3px;}
            .button		{margin:5px; padding:4px 13px; font-size:1.02em; color:#007FFF; background-color:#fff; border:none; border-radius:5px}
            #space		{line-height:8px;}
            #leftAlignBlock	{display:block; margin-left:auto; margin-right:auto; width:200px; text-align:left;}
            #tiny		{margin-top:15px; line-height:16px; font-size:0.7em;}
            -->
        </style>
    </head>
    <body>
        <main>
            <div id="topBar">Clinical Coder v0.1</div>
            <div id="inner">
                <form action="login.php" method="POST">
                    <div id="topBorder">
                        <div id="space">&nbsp;</div>
                        <div id="space">&nbsp;</div>
                        <div id="formTitle">
                            Please Sign In<br>
                        </div>
                        <div id="tiny">Please sign in using your [Health Department]<br>credentials to access this system.</div>
                        <br>
                        <div id="leftAlignBlock">
                            <label for="username">Username:</label><br>
                            <input class="field" name="usr" type="text" min="2" max="25" required autofocus>
                            <div id="space">&nbsp;</div>
                            <label for="password">Password:</label><br>
                            <input class="field" name="pwd" type="password" min="8" max="50" required>
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
