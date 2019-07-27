<?php
session_start();
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
        <script	src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.multiselect').select2();
            });
        </script>
    </head>
    <body>
        <form>
            <select class="multiselect" name="symptoms[]" multiple="multiple">
                <?php
                $file = file("../Testing Area/test.txt");
                $index = 0;
                foreach ($file as $name) {
                    echo "<option value=\"" . $index . "\">" . trim($name) . "</option>";
                    $index++;
                }
                ?>
            </select>
            <input type="submit">
            <noscript>
            <style type="text/css">
                .multiselect {display:none;}
            </style>
            <select name="symptoms-nojs[]<?php count(@$_POST['symptoms-nojs']) ?>" multiple="multiple">
                <?php
                $index -= $index;
                foreach ($file as $name) {
                    echo "<option value=\"" . $index . "\">" . trim($name) . "</option>";
                    $index++;
                }
                ?>
            </select>
            <input type="submit">
            </noscript>
        </form>
    </body>
</html>
