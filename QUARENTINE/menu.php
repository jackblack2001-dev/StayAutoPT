<?php
$url1 = ROOT_PATH . 'icons/star.svg';
$url2 = ROOT_PATH . 'icons/star-fill.svg';
?>

<nav class="navbar navbar-expand-md navbar-light gradient-color">
    <a class="navbar-brand" href="<?= ROOT_PATH ?>index.php">StayAuto Portugal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="" class="nav-link"><i class="fa fa-car"></i> Carros</a>
                <?php
                if (isset($_SESSION['Profile']) && $_SESSION['Profile'] == '0') {
                    echo '<li class="nav-item active">
                    <a href="' . ROOT_PATH . 'User_Admin/Admin_Dashboard.php" class="nav-link">Dashbord</a> 
                    </li>';

                    echo '<div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown">Gestão</a>
                            <ul class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="' . ROOT_PATH . 'User_Admin/Index_Users.php">Utilizadores</a>
                            <a class="divider"></a>
                            <a class="dropdown-item text-danger" href="' . ROOT_PATH . 'User_Admin/Index_Ban.php">Denuncias</a>
                            </li>
                        </div>';
                } else if (isset($_SESSION['Profile']) && $_SESSION['Profile'] == '2') {
                    echo ' <li class="nav-item active">
                    <a href="' . ROOT_PATH . 'User_Stand/Stand_Dashboard.php" class="nav-link">O meu Stand</a> 
                    </li>
                    <li class="nav-item active">
                    <a href="' . ROOT_PATH . 'User_Stand/Garage.php" class="nav-link">Garagem</a>
                    </li>';
                } else {
                    echo '';
                }
                ?>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <i class="fa fa-envelope-o"></i>
                <span class="badge badge-danger badge-counter">7</span>
            </li>
            <li class="nav-item active">
                <a class="nav-link" type="button" class="btn btn-primary"><i class="fa fa-star-o fa-lg"></i></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link"></a>
            </li>
            <div class="nav-item dropdown">
                <?php
                if (!isset($_SESSION['Id']) || empty($_SESSION['Id'])) {
                    echo '<a href="Login.php" class="nav-link" type="button" class="btn btn-primary"><img src="' . ROOT_PATH . 'icons/person.svg" width="20px" height="20px">Conta</a>';
                } else {
                    echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown"><img src="' . ROOT_PATH . 'Public/Images/Profile/defult_user.jpg" Class="rounded-circle text-center"/></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="' . ROOT_PATH . 'User/Profile.php">Perfil</a>
                            <a class="dropdown-item" href="' . ROOT_PATH . 'logout.php">Logout</a>
                        </ul>';
                }
                ?>
            </div>
        </ul>
    </div>
</nav>