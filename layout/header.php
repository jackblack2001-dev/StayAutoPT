<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayAuto Portugal</title>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>font-awesome/css/font-awesome.min.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>ckeditor/ckeditor.js"></script>
    <style>
        /* Index */
        .div-5-most-viewed {
            white-space: nowrap;
            overflow-x: scroll;
            overflow-y: hidden;
            padding-left: 20px;
            padding-right: 20px;
            margin-left: -20px;
            margin-right: -20px;
        }

        .div-5-most-viewed .card {
            display: inline-block;
            margin-left: auto !important;
        }

        .top-left-5-most-viewed {
            position: absolute;
            bottom: 365px;
            left: -13px;
            background-color: #d39e00;
            color: white;
            padding-left: 10px;
            padding-right: 10px;
        }

        .div-other-cars {
            padding-left: 30px;
        }

        @media (max-width:1840px) {
            .div-other-cars {
                padding-left: 190px;
            }
        }

        @media (max-width:1700px) {
            .div-other-cars {
                padding-left: 0px;
            }
        }

        /* car search */
        .pagination {
            list-style-type: none;
            padding: 10px 0;
            display: inline-flex;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .pagination li {
            box-sizing: border-box;
            padding-right: 10px;
        }

        .pagination li a {
            box-sizing: border-box;
            background-color: #e2e6e6;
            padding: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            color: #616872;
            border-radius: 4px;
        }

        .pagination li a:hover {
            background-color: #d4dada;
        }

        .pagination .next a,
        .pagination .prev a {
            text-transform: uppercase;
            font-size: 12px;
        }

        .pagination .currentpage a {
            background-color: #518acb;
            color: #fff;
        }

        .pagination .currentpage a:hover {
            background-color: #518acb;
        }

        /*  */

        .a-cars {
            color: #000000;
            text-decoration: none !important;
        }

        .a-carousel-stands {
            color: #ffffff;
            text-decoration: none !important;
        }

        .card {
            border: 1px groove #8c8e8c38;
        }

        .container-fluid {
            padding-left: 40px;
            padding-right: 40px;
        }

        .text-dark {
            color: #5a5c69 !important;
        }

        .rounded-circle {
            object-fit: cover;
            Width: 35px;
            Height: 35px;
        }

        .nav-link {
            padding: 0 0 0;
        }

        .gradient-color {
            background-color: darkorange;
            background-image: linear-gradient(180deg, darkorange, #c54444);
        }

        .border-left-primary {
            border-left: .25rem solid #4e73df !important;
        }

        .border-left-success {
            border-left: .25rem solid #1cc88a !important;
        }

        .border-left-warning {
            border-left: .25rem solid #f6c23e !important;
        }

        .border-left-danger {
            border-left: .25rem solid #e74a3b !important;
        }

        .text-xs {
            font-size: .7rem;
        }

        .aling-items-center {
            align-items: center !important;
        }

        .no-gutters {
            margin-right: 0;
            margin-left: 0;
        }

        #photo {
            width: 100%;
            height: 300px;
        }

        .bottom-right-stand {
            position: absolute;
            bottom: 20px;
            right: -40px;
            background-color: black;
            color: white;
            padding-left: 20px;
            padding-right: 20px;
        }

        .bottom-right-car {
            position: absolute;
            bottom: -15px;
            right: 15px;
            background-color: #0a3f82e0;
            color: white;
            padding-left: 10px;
            padding-right: 10px;
        }


        /* Profile */
        .Img_Banner {
            height: 400px;
            width: 100%;
            position: relative;
        }

        .Img_Profile {
            width: 180px;
            height: 180px;
        }

        .overlay-profile-banner {
            position: absolute;
            bottom: 0px;
            opacity: 0;
            height: 100%;
            width: 100%;
            transition: .3s ease;

            border-width: 5px;
            border-style: dashed;
            color: #909090;
        }

        .div-overlay-profile-banner {
            position: relative;
        }

        .div-overlay-profile-banner:hover .overlay-profile-banner {
            opacity: 1;
        }

        .overlay-profile-badge {
            position: absolute;
            top: 0px;
            opacity: 0;
            transition: .3s ease;
            border-width: 5px;
            border-style: dashed;
            color: #909090;
        }

        .div-overlay-profile-badge {
            width: 170px;
            position: absolute;
            top: 280px;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        .div-overlay-profile-badge:hover .overlay-profile-badge {
            opacity: 1;
        }

        .div_profile_name{
            margin-top: 30px;
        }

        /* Stand Dasboard */
        .overlay-sd {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .3s ease;

            border-width: 5px;
            border-style: dashed;
            color: #909090;
        }

        .div-overlay-sd {
            text-align: center;
            vertical-align: middle;
            position: relative;
        }

        .div-overlay-sd:hover .overlay-sd {
            opacity: 1;
        }

        .sd-most-view-car {
            margin-left: 200px !important;
        }

        @media (max-width:760px) {
            .sd-most-view-car {
                margin-left: 0px !important;
                width: 100% !important;
            }
        }

        .top-left-most-view-car {
            position: absolute;
            bottom: 360px;
            right: 180px;
            background-color: #d39e00;
            color: white;
            padding-left: 10px;
            padding-right: 10px;

        }

        /* Stand Profile */

        .overlay-stand-profile-banner {
            position: absolute;
            bottom: 0px;
            opacity: 0;
            height: 100%;
            width: 100%;
            transition: .3s ease;

            border-width: 5px;
            border-style: dashed;
            color: #909090;
        }

        .div-overlay-stand-profile-banner {
            position: relative;
        }

        .div-overlay-stand-profile-banner:hover .overlay-stand-profile-banner {
            opacity: 1;
        }

        .overlay-stand-profile-badge {
            position: absolute;
            bottom: 0px;
            opacity: 0;
            transition: .3s ease;

            border-width: 5px;
            border-style: dashed;
            color: #909090;
        }

        .div-overlay-stand-profile-badge {
            bottom: 130px;
            left: 30px;
            margin-right: 930px;
            position: relative;
        }

        .div-overlay-stand-profile-badge:hover .overlay-stand-profile-badge {
            opacity: 1;
        }

        .div_nc {
            white-space: nowrap;
            overflow-x: scroll;
            overflow-y: hidden;
        }

        .div_nc .card {
            display: inline-block;
            margin-left: auto !important;
        }

        .top-right-stand-name {
            position: absolute;
            bottom: 350px;
            right: -20px;
            background-color: #0404049c;
            color: white;
            padding-left: 10px;
            padding-right: 10px;

        }

        .top-left-stand-map-placeholder {
            position: absolute;
            bottom: 215px;
            right: 415px;
            background-color: #909090c4;
            color: white;
            padding-left: 10px;
            padding-right: 10px;
        }

        @media (max-width:990px) {
            .div-google-map {
                display: none;
            }

            .col-md-4 {
                flex: none !important;
                max-width: none !important;
            }
        }

        /* Car_Profile */
        .card-car-info {
            padding-right: 140px;
            padding-left: 140px;
        }

        .top-left-car-price {
            position: absolute;
            bottom: 450px;
            right: 834px;
            background-color: #0052a7;
            color: white;
            padding-left: 10px;
            padding-right: 10px;

        }

        /* Garage */
        .div_5 {
            white-space: nowrap;

        }

        @media (max-width:1860px) {
            .div_5 {
                overflow-x: scroll;
                overflow-y: hidden;
            }
        }

        .div_5 .card {
            display: inline-block;
        }

        .Header {
            padding-top: 17px;
            font-size: 35px;
            font-family: 'Open Sans', sans-serif;
            opacity: 1;
            filter: blur(0px) brightness(100%) contrast(100%) grayscale(0%) hue-rotate(0deg) invert(0%);
        }

        .div_error {
            padding-top: 0px;
            padding-bottom: 20px;
        }

        .no-padding {
            padding: 0px 0px 0px !important;
        }

        .margins {
            margin-left: 10px;
            margin-right: 10px;
        }

        .message-badge {
            position: relative;
            right: 15px;
            bottom: 9px;
        }

        .carousel-item img {
            width: 100%;
            height: 500px;
        }

        .google-map {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>