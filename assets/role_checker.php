<?php

function roleStand($profile)
{
    if (empty($profile) || $profile != '2') {
        header('Location:' . ROOT_PATH . 'Index.php');
    } else {
        return null;
    }
}

function roleUser($profile)
{
    if (empty($profile) || $profile != '1') {
        header('Location:' . ROOT_PATH . 'Index.php');
    } else {
        return null;
    }
}

function roleAdmin($profile)
{
    if ($profile != '0') {
        header('Location: ../Index.php');
        exit;
    } else {
        return null;
    }
}
