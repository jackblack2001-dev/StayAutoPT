<?php

function remove_tmp_US()
{
    $files = glob("../User_Stand/tmp/".$_SESSION['Id']."/*");
    foreach ($files as $file) {
        if (is_file($file))
            unlink($file);
    }
}
