<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
include("assets/user_info.php");
include("Public/Config.php");
include("assets/message_user.php");
include("assets/role_checker.php");

if (!isset($_GET["isS"])) {
    header("location: Index.php");
}

$issend = base64_decode($_GET["isS"]);

include("layout/header.php");
include("layout/menu.php");
?>

<div class="container">
    <?php if ($issend == true) : ?>
        <p class="text-center mt-4">
            <h3>Email de Confirmação Enviado</h3>

            <p class="mt-4">Email de Ativação da conta enviado para <cite><?= isset($_SESSION["Email"]) ? $_SESSION["Email"] : "OCORREU UM ERRO" ?></cite>.</p>

            <a href="Index.php" class="btn btn-outline-success">Ir para a pagina Inicial</a>
        </p>
    <?php else : ?>
        <p class="text-center mt-4">
            <h3>Ocorreu um erro</h3>

            <p class="mt-4">Não foi possivel enviar um email de confirmção, por favor tente mais tarde</p>

            <a href="<?= ROOT_PATH ?>Index.php" class="btn btn-outline-success">Ir para a pagina Inicial</a>
        </p>
    <?php endif ?>
</div>

<?php include("layout/footer.php") ?>