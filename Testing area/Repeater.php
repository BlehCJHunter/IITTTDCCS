<!DOCTYPE html>
<html>
	<head>
             <meta charset="UTF-8">
		<title>
			Test
		</title>
	</head>
	<body>
            Keywords: <?php foreach ($_POST as $key => $word) { echo $word . ", "; } ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                Add keyword: <input type="text" name="<?php echo "keyword" . count($_POST); ?>">
                <?php
                foreach ($_POST as $word => $wordvalue) { echo "<input type=\"hidden\" name=\"" . $word . "\" value=\"" . $wordvalue . "\">"; }
                ?>
                <input type="submit">
            </form>
	</body>
</html>