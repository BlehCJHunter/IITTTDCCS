<?php
$WhereTheHeckOurAboutPageIs = "about.php"; //Mike, this is yours to deal with
?>
<nav>
    <ul>
        <li><a href="CCS/login.php">Clinical Coding System</a></li>
        <li><a href="Testing area/index.php">Testing area</a></li>
        <li><a href="Testing area/testForJoe.php">Test for Joe</a></li>
        <li><a href="<?php echo $WhereTheHeckOurAboutPageIs; ?>">About Us</a></li>
    </ul>
</nav>