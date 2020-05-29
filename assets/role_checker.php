<?php

function roleStand()
{
    if (isset($_SESSION['Id'])) {
        if (!isset($_SESSION['Profile']) || $_SESSION['Profile'] != "2") {
            header('Location:' . ROOT_PATH . 'Index.php');
        }
    } else {
        header('Location:' . ROOT_PATH . 'Index.php');
    }
}

function roleUser()
{
    if (!isset($_SESSION['Id']) && !isset($_SESSION['Profile'])) {
        header('Location:' . ROOT_PATH . 'Index.php');
    }
}

function roleAdmin()
{
    if (isset($_SESSION['Id'])) {
        if (!isset($_SESSION['Profile']) || $_SESSION['Profile'] != "0") {
            header('Location:' . ROOT_PATH . 'Index.php');
        }
    } else {
        header('Location:' . ROOT_PATH . 'Index.php');
    }
}
