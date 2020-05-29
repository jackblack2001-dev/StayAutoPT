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
                    $fileDestination .= "/" . $fileDefName;
                    move_uploaded_file($fileTempName, $fileDestination);

                    if ($who == "stand") {
                        if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                            header("location: ../User_Stand/Stand_Profile.php?id=" . $id);
                        } else header("location: ../User_Stand/Stand_Profile.php");
                    } else if ($who == "user") {
                        if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                            header("location: ../User/Profile.php?id=" . $id);
                        } else header("location: ../User/Profile.php");
                    }

                    if ($who == "car" && $type == "thumbnail") {
                        echo '<div class="mr-2 mb-1">
                                <img src="' . $fileDestination . '" alt="' . $fileName . '" width="100px" height="100px" style="border: #d6d6d6; border-style: outset">
                            </div>';
                    }
                }
            } else {
                $error = "O tamanha da Imagem Submetida não pode exeder os 5mb!";
                if ($who == "stand") {
                    if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                        header("location: ../User_Stand/Stand_Profile.php?id=" . $id . "&error=" . $error);
                    } else header("location: ../User_Stand/Stand_Profile.php?error=" . $error);
                } else if ($who == "user") {
                    if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                        header("location: ../User/Profile.php?id=" . $id . "&error=" . $error);
                    } else header("location: ../User/Profile.php?error=" . $error);
                }
            }
        } else {
            $error = "A imagem submetida esta corrompida!";
            if ($who == "stand") {
                if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                    header("location: ../User_Stand/Stand_Profile.php?id=" . $id . "&error=" . $error);
                } else header("location: ../User_Stand/Stand_Profile.php?error=" . $error);
            } else if ($who == "user") {
                if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                    header("location: ../User/Profile.php?id=" . $id . "&error=" . $error);
                } else header("location: ../User/Profile.php?error=" . $error);
            }
        }
    } else {
        $error = "A extenção deste ficheiro não é permitida!";
        if ($who == "stand") {
            if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                header("location: ../User_Stand/Stand_Profile.php?id=" . $id . "&error=" . $error);
            } else header("location: ../User_Stand/Stand_Profile.php?error=" . $error);
        } else if ($who == "user") {
            if ($id != $_SESSION['Id'] && $_SESSION['Profile'] == "0") {
                header("location: ../User/Profile.php?id=" . $id . "&error=" . $error);
            } else header("location: ../User/Profile.php?error=" . $error);
        }
    }
}
