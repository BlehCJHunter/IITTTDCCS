<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Clinical Coder v1.0</title>
<meta name="description" content="This website exists as a proof of concept for an Automated Clinical Coding System">
<meta name="keywords" content="clinical coding system, proof of concept">
<meta name="author" content="Brendan, Callum, Jess, Joe, Michael, Won">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="css/baseStyle.css">
<style type="text/css">
<!--
html, body	{height:100%; font-family:"Arial Black", Gadget, sans-serif;}
main		{display:table; position:absolute; top:0; left:0; height:100%; width:100%;}
#topBar		{position:absolute; width:100%; height:40px; text-align:center; line-height:40px; font-weight:bold; color:#444; background-color:#eee; z-index:2}
#inner		{display:table-cell; vertical-align:middle}
main form	{margin-left:auto; margin-right:auto; width:260px; text-align:center; color:#666;}
#topBorder, #bottomBorder	{width:260px;}
#topBorder	{background-color:#fafafa; border:1px solid #bbb; border-bottom:0px; border-radius:15px 15px 0px 0px;}
#bottomBorder	{line-height:35px; border:1px solid #bbb; border-radius:0px 0px 15px 15px;}
#formTitle	{font-size:0.95em; font-weight:bold;}
.field		{width:200px; height:23px; border:1px solid #aaa; border-radius:3px;}
.button		{margin:5px; padding:4px 13px; font-size:1.02em; color:#007FFF; background-color:#fff; border:none; border-radius:5px}
#space		{line-height:8px;}
#leftAlignBlock	{display:block; margin-left:auto; margin-right:auto; width:200px; text-align:left;}
#tiny		{font-size:0.65em;}
-->
</style>
</head>
<body>
<main>
  <div id="topBar">Clinical Coder v1.0</div>
  <div id="inner">
    <form action="/action_page.php">
      <div id="topBorder">
	<div id="space">&nbsp;</div>
	<div id="space">&nbsp;</div>
	<div id="formTitle">
	  Please Sign In<br>
	  <span id="tiny">Please sign in using your [Health Department]<br>credentials to access this system.</span>
	</div>
	<br>
	<div id="leftAlignBlock">
	  <label for="username">Username:</label><br>
	  <input class="field" name="username" type="text" min="2" max="25" required autofocus>
	  <div id="space">&nbsp;</div>
	  <label for="password">Password:</label><br>
	  <input class="field" name="password" type="password" min="8" max="50" required>
	</div>
	  <br><br>
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
