<?php
session_start();

if (isset($_FILES["carphotos"])) {
    if ($_FILES["carphotos"]["error"] == UPLOAD_ERR_OK) {

        $fileName = $_FILES['carphotos']['name'];

        $fileExt = explode(".", $fileName);
        $fileAE = strtolower(end($fileExt));

        $allowed = array("jpeg", "png", "jpg");

        if (in_array($fileAE, $allowed)) {
            $fileDefName = uniqid('', true) . "." . $fileAE;

            $tmp_path = $_FILES["carphotos"]["tmp_name"];
            $def_path = "../User_Stand/tmp/" . $_SESSION['Id'];

            if (is_dir($def_path)) {
                $def_path .= "/" . $fileDefName;
                move_uploaded_file($tmp_path, $def_path);
            } else {
                mkdir($def_path);
                $def_path .= "/" . $fileDefName;
                move_uploaded_file($tmp_path, $def_path);
            }

            echo '<div class="mr-2 mb-1">
                    <img src="' . $def_path . '" alt="' . $fileName . '" width="100px" height="100px" style="border: #d6d6d6; border-style: outset">
                </div>';
        } else {
            echo "";
        }
    } else {
        echo "";
    }
} else {
    echo "";
}
