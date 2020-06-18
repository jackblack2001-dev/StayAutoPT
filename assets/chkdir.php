<?php
include("stand_user.php");
include("user_info.php");
include("car_stand.php");

function dirExists($who, $type, $id, $filename, $con)
{
    if ($who == "stand") {

        if ($type == "thumbnail_banner") {
            $photoDestination = "../User_Stand/tmp/" . $id . "/banner";
            if (is_dir($photoDestination)) {
                return $photoDestination;
            } else {
                mkdir($photoDestination, 0777, true);
                return $photoDestination;
            }
        }

        if ($type == "thumbnail_badge") {
            $photoDestination = "../User_Stand/tmp/" . $id . "/badge";
            if (is_dir($photoDestination)) {
                return $photoDestination;
            } else {
                mkdir($photoDestination, 0777, true);
                return $photoDestination;
            }
        }

        if ($type == "banner") {
            $bannerDestination = "../Public/Images/Stand_Banners/" . $id;

            if (InsertBanner($con, $id, $filename)) {
                if (is_dir($bannerDestination)) {
                    return $bannerDestination;
                } else {
                    mkdir($bannerDestination, 0777, true);
                    return $bannerDestination;
                }
            } else return false;
        }

        if ($type == "badge") {
            $bagdeDestination = "../Public/Images/Stand_Badge/" . $id;

            if (InsertBadge($con, $id, $filename)) {
                if (is_dir($bagdeDestination)) {
                    return $bagdeDestination;
                } else {
                    mkdir($bagdeDestination, 0777, true);
                    return $bagdeDestination;
                }
            } else return false;
        }
    }

    if ($who == "user") {
        if ($type == "banner") {
            $bannerDestination = "../Public/Images/User_Banners/" . $id;

            if (UpdateUserBanner($filename, $id, $con)) {
                if (is_dir($bannerDestination)) {
                    return $bannerDestination;
                } else {
                    mkdir($bannerDestination, 0777, true);
                    return $bannerDestination;
                }
            } else return false;
        }

        if ($type == "badge") {
            $bagdeDestination = "../Public/Images/User_Badge/" . $id;

            if (UpdateUserBadge($filename, $id, $con)) {
                if (is_dir($bagdeDestination)) {
                    return $bagdeDestination;
                } else {
                    mkdir($bagdeDestination, 0777, true);
                    return $bagdeDestination;
                }
            } else return false;
        }
    }

    if ($who == "car") {

        $photoDestination = "";

        if ($type == "thumbnail") {
            $photoDestination = "../User_Stand/tmp/" . $id;
            if (is_dir($photoDestination)) {
                return $photoDestination;
            } else {
                mkdir($photoDestination, 0777, true);
                return $photoDestination;
            }
        }

        if ($type == "update") {
            $photoDestination = "../Public/Images/Car_Photos/" . $id;
            if (InsertPhotos($con, $id, $filename)) {
                if (is_dir($photoDestination)) {
                    return $photoDestination;
                } else {
                    mkdir($photoDestination, 0777, true);
                    return $photoDestination;
                }
            } else return false;
        }
    }
}
