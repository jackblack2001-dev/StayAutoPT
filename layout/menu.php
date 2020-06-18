<?php
if (isset($_SESSION['Id'])) {
    $row = returnUser($_SESSION['Id'], $con);
    if ($row['Badge'] != null) {
        $badge = ROOT_PATH . "Public/Images/User_Badge/" . $row["User_Id"] . "/" . $row["Badge"];
    } else {
        $badge = ROOT_PATH . "Public/Images/User_Badge/default_user_badge.jpg";
    }

    $messages = badgeNumNewMessages($_SESSION['Id'], $con);
}

?>

<nav class="navbar navbar-expand-lg navbar-light gradient-color">
    <a class="navbar-brand" href="<?= ROOT_PATH ?>index.php">StayAuto Portugal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a href="<?= ROOT_PATH ?>Car_Search.php" class="nav-link"><i class="fa fa-car"></i> Carros</a>
            </li>
            <li class="nav-item">
                <a href="<?= ROOT_PATH ?>Stand_Search.php" class="nav-link">Stands</a>
            </li>
            <?php
            if (isset($_SESSION['Profile']) && $_SESSION['Profile'] == '0') {
                echo '<li class="nav-item">
                        <a href="' . ROOT_PATH . 'User_Admin/Admin_Dashboard.php" class="nav-link">Dashbord</a> 
                      </li>';

                echo '<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Gestão
                        </a>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="' . ROOT_PATH . 'User_Admin/Index_Users.php">Utilizadores</a>
                            <a class="dropdown-item text-danger" href="' . ROOT_PATH . 'User_Admin/Index_Ban.php">Denuncias</a>
                        </div>
                    </li>';
            } else if (isset($_SESSION['Profile']) && $_SESSION['Profile'] == '2') {
                echo '<li class="nav-item">
                        <a href="' . ROOT_PATH . 'User_Stand/Stand_Dashboard.php" class="nav-link">O meu Stand</a> 
                    </li>';

                echo '<li class="nav-item">
                        <a href="' . ROOT_PATH . 'User_Stand/Garage.php" class="nav-link">Garagem</a>
                    </li>';
            }
            ?>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['Id']) || !empty($_SESSION['Id'])) : ?>
                <li class="nav-item">
                    <a class="nav-link no-padding" type="button">
                        <i class="fa fa-envelope-o fa-lg <?= $messages["New_Messages"] == 0 ? "mr-4" : "" ?>"></i>
                        <?php if ($messages["New_Messages"] > 0) : ?>
                            <span class="badge badge-danger badge-counter message-badge"><?= $messages["New_Messages"] ?></span>
                        <?php endif ?>
                    </a>
                </li>
            <?php endif ?>
            <li class="nav-item mr-4">
                <a class="nav-link no-padding" type="button">
                    <i class="fa fa-star-o fa-lg"></i>Favoritos
                </a>
            </li>
            <?php
            if (!isset($_SESSION['Id']) || empty($_SESSION['Id'])) {
                echo '<a href="' . ROOT_PATH . 'Login.php" class="nav-link" type="button" class="btn btn-primary"><i class="fa fa-sign-in"></i>Login</a>';
            } else {

                echo '<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="' . $badge . '" Class="rounded-circle text-center"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="' . ROOT_PATH . 'User/Profile.php">Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="' . ROOT_PATH . 'logout.php"><i class="fa fa-sign-out"></i>Logout</a>
                </div>
            </li>';
            }
            ?>

        </ul>
    </div>
</nav>