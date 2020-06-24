<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/stand_user.php");
include("assets/message_user.php");
include("assets/car_stand.php");

if (!isset($_GET["id"])) {
    header("location: Index.php");
} else {
    $success = false;

    $id = base64_decode($_GET["id"]);

    if (SeeEmailExists($id, $con)) {
        if (ActivateAcount($id, $con)) {
            $success = true;

            if (isset($_SESSION["Id"])) {
                $_SESSION["IsActivated"] = 1;
            }
        }
    }
}

include("layout/header.php");
include("layout/menu.php");
?>
<div class="container">
    <?php if ($success == true) : ?>
        <p class="text-center mt-4">
            <h3>Email Confirmado com Sucesso</h3>

            <p class="mt-4">Agora pode usufruir de tudo o que o nosso site tem a oferecer.</p>

            <a href="Index.php" class="btn btn-outline-success">Ir para a pagina Inicial</a>
        </p>
    <?php else : ?>
        <p class="text-center mt-4">
            <h3>Ocorreu um erro</h3>

            <p class="mt-4">Não foi possivel Confirmar o email, por favor tente mais tarde</p>

            <a href="Index.php" class="btn btn-outline-success">Ir para a pagina Inicial</a>
        </p>
    <?php endif ?>
</div>
<?php include("layout/footer.php") ?>