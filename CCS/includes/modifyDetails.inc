<?php
$ref = htmlspecialchars(stripslashes(strip_tags($_SERVER['HTTP_REFERER'])));
echo $ref;
?>