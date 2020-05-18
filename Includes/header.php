<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayAuto Portugal</title>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>bootstrap/css/fontawesome.min.css">
    <style>
        .card {
            border: 1px #8c8e8cd1;
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
            right: 30px;
            background-color: black;
            color: white;
            padding-left: 20px;
            padding-right: 20px;
        }

        .bottom-right-car {
            position: absolute;
            bottom: -15px;
            right: 30px;
            background-color: black;
            color: white;
            padding-left: 10px;
            padding-right: 10px;
        }

        .Img_Banner {
            height: 400px;
            width: 100%;
            position: relative;
        }

        .Img_Profile {
            width: 180px;
            height: 180px;
            margin-left: 0px;
            filter: blur(0px);
        }

        .overlay {
            position: absolute;
            top: 80px;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .3s ease;
        }

        .div-overlay {
            margin-top: -100px;
            text-align: center;
            vertical-align: middle;
            position: relative;
        }

        .div-overlay:hover .overlay {
            opacity: 1;
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

        .no-padding{
            padding: 0;
        }

        .margins{
            margin-left: 10px;
            margin-right: 10px;
        }
    </style>
</head>

<body>