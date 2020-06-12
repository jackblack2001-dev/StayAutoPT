<?php
session_start();
include("../Public/config.php");
include("chkdir.php");

if (isset($_POST['who']) || isset($_POST['type']) || isset($_POST['id'])) {

    $error = "";

    $who = $_POST['who'];
    $type = $_POST['type'];
    $id = $_POST['id'];

    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    $fileExt = explode(".", $fileName);
    $fileAE = strtolower(end($fileExt));

    $allowed = array("jpeg", "png", "jpg");

    if (in_array($fileAE, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000000) {
                $fileDefName = uniqid('', true) . "." . $fileAE;

                $fileDestination = dirExists($who, $type, $id, $fileDefName, $con);

                if ($fileDestination == false) {
                    /* return db error */
                } else {
                    $files = glob($fileDestination.'/*'); // get all file names
                    foreach ($files as $file) { // iterate files
                        if (is_file($file))
                            unlink($file); // delete file
                    }

                    $fileDestination .= "/" . $fileDefName;

                    move_uploaded_file($fileTempName, $fileDestination);

                    echo '<div class="mr-2 mb-1">
                                <img src="' . $fileDestination . '" alt="' . $fileName . '" width="100px" height="100px" style="border: #d6d6d6; border-style: outset">
                            </div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-2" role="alert">
                            O tamanha da Imagem Submetida não pode exeder os 5mb!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>';
            }
        } else {
            echo '<div class="alert alert-danger mt-2" role="alert">
                        A imagem submetida esta corrompida!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger mt-2" role="alert">
                        A extenção deste ficheiro não é permitida!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>';
    }
}
