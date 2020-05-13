<?php
session_start();
define("ROOT_PATH", "http://".$_SERVER["HTTP_HOST"]."/StayAutoPT/"); 
define("INCLUDE_PATH",__DIR__);
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>StayAuto Portugal</title>

  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="<?=ROOT_PATH?>bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="<?=ROOT_PATH?>bootstrap/css/fontawesome.min.css">
  <script src="<?=ROOT_PATH?>bootstrap/js/jquery.min.js"></script>
  <script src="<?=ROOT_PATH?>bootstrap/js/bootstrap.js"></script>
</head>

<body>
  <style>
    .rounded-circle {
      object-fit: cover;
      Width: 35px;
      Height: 35px;
    }
  </style>

  <nav class="navbar navbar-expand-xl navbar-light" style="background-color:darkorange">
    <a class="navbar-brand" href="<?=ROOT_PATH?>index.php">StayAuto Portugal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse  mr-auto" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <?php echo (isset($_SESSION['Profile']) && ($_SESSION['Profile'] == '2'))
            ? ' <li class="nav-item active">
                <a href="'.ROOT_PATH.'User_Stand/Stand_Dashboard.php" class="nav-link">O meu Stand</a> 
                </li>
                <li class="nav-item active">
                <a href="'.ROOT_PATH.'User_Stand/Garage.php" class="nav-link">Garagem</a>
                </li>'
            : '<a href="" class="nav-link"><img src="Icons/Car.svg" width="25px" height="30px"> Carros</a>'
          ?>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" type="button" class="btn btn-primary"><img src="<?php echo ROOT_PATH?>icons/star.svg" width="25px" height="25px"> Favoritos</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link">|</a>
        </li>
        <div class="nav-item dropdown">
          <li>
            <?php $Path = ROOT_PATH . 'Public/Images/Profile/' . 'defult_user.jpg';?>
            <?php echo (!isset($_SESSION['Id']) || empty($_SESSION['Id']))
              ? '<a href="Login.php" class="nav-link" type="button" class="btn btn-primary"><img src="icons/person.svg" width="20px" height="20px"> Conta</a>'
              : '<a class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="' . $Path . '" Class="rounded-circle" /></a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="/User/Perfil.aspx">Perfil</a>
            <a class="divider"></a>
            <a class="dropdown-item" href="'.ROOT_PATH.'logout.php">Logout</a>
            </div>' ?>
          </li>
        </div>
      </ul>
    </div>
  </nav>
</body>

</html>