<?php
echo basename(htmlspecialchars(stripslashes(strip_tags($_SERVER['PHP_SELF'])))) . "<br>";

require 'includes/modifyDetails.inc';
?>