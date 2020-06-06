<?php
session_start();
include('../Public/config.php');
include('../assets/stand_user.php');

if (isset($_GET['id_stand']) && isset($_GET['id_news']) && !isset($_GET['aux'])) {
    if ($_GET['id_news'] == 0) {
        GetLastNew($_GET['id_stand'], $con);
    } else {
        GetNew($_GET['id_news'], $_GET['id_stand'], $con);
    }

    UpdateNewsId($_GET['id_news'], $_GET['id_stand'], $con);
}

if (isset($_GET['id_stand']) && isset($_GET['id_news']) && isset($_GET['aux'])) {
    if ($_GET['aux'] == true) {
        echo json_encode(returnNew($_GET['id_news'], $_GET['id_stand'], $con));
    }
}

if (isset($_POST['title']) && isset($_POST['text']) && isset($_POST['standid'])) {
    InsertNews($_POST['standid'], $_SESSION['Id'], $_POST['title'], $_POST['text'], $con);
    header("location: ../User_Stand/Stand_Profile.php");
}

if (isset($_POST['id_news']) && isset($_POST['title']) && isset($_POST['updatetext'])) {
    UpdateNew($_POST['id_news'], $_POST['title'], $_POST['updatetext'], $con);
    header("location: ../User_Stand/Stand_Profile.php");
}

function error()
{
    echo '<div class="mr-4 ml-4" style="border-width:3px;border-style:dashed;width:100%; color: lightgray">
        <br>
        <h3 class="text-center">
            Ainda não inseriu nenhuma Notícia
        </h3>
        <br>
        </div>';
}

function news($title, $text, $date)
{
    echo "<div class='card shadow margins mb-4' style='width: 100%'>
            <div class='card-body'>
            <div class='row'>
                <div class='col'>
                    <h3>" . $title . "</h3>
                </div>
                <div class='col'>
                   <p class='float-right'>Em: " . $date . "</p> 
                </div>
            </div>
                
                <hr>
                <div>
                " . $text . "
                </div>   
            </div>
        </div>";
}

function GetLastNew($id, $con)
{
    $data = returnLastNew($id, $con);

    if ($data[0] != null) {
        $date = explode(" ", $data["CreatedNews"]);
        news($data["Title"], $data["Text"], $date[0]);
    } else {
        error();
    }
}

function GetNew($idnews, $idstand, $con)
{
    $data = returnNew($idnews, $idstand, $con);

    if ($data[0] != null) {
        $date = explode(" ", $data["CreatedNews"]);
        news($data["Title"], $data["Text"], $date[0]);
    } else {
        error();
    }
}
