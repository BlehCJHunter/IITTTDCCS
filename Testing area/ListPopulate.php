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
        <form method="post" target="">
            <select>
                <?php
                $file = file("./test.txt");
                $index = 0;
                foreach ($file as $name) {
                    echo "<option value=\"" . $index . "\">" . trim($name) . "</option>";
                    $index++;
                }
                ?>
            </select
        </form>
    </body>
</html>
