<?php

/**
 * (1) run serve.sh in a shell
 * (2) open http://127.0.0.1:8080/
 * (3) select a file < 300kB size, e.g. the "testfile.txt"
 * (4) click send
 * (5) check displayed values, IsUploadedFile and MoveUploadedFile should both be 1 (true)
 * (6) check the uploaded file /tmp/phpTmpName.txt
 */

$name = $_FILES['userfile']['name'] ?? '';
$type = $_FILES['userfile']['type'] ?? '';
$tmp_name = $_FILES['userfile']['tmp_name'] ?? '';
$error = $_FILES['userfile']['error'] ?? '';
$size = $_FILES['userfile']['size'] ?? '';

?><!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>

<label for="name">Name:</label><input id="name" type="text" value="<?= $name?>"><br />
<label for="type">Type:</label><input id="type" type="text" value="<?= $type?>"><br />
<label for="tmp_name">TmpName:</label><input id="tmp_name" type="text" value="<?= $tmp_name?>"><br />
<label for="error">Error:</label><input id="error" type="text" value="<?= $error?>"><br />
<label for="size">Size:</label><input id="size" type="text" value="<?= $size?>"><br />
<label for="isUploadedFile">IsUploadedFile:</label><input id="isUploadedFile" type="text" value="<?= is_uploaded_file($tmp_name) ?>"><br />
<label for="moveUploadedFile">MoveUploadedFile:</label><input id="moveUploadedFile" type="text" value="<?= move_uploaded_file($tmp_name, '/tmp/phpTmpName.txt') ?>"><br />
