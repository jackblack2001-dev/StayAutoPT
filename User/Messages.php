<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include('../Public/config.php');
include('../assets/stand_user.php');
include('../assets/role_checker.php');
include("../assets/user_info.php");
include("../assets/message_user.php");

roleUser();

$id = $_SESSION["Id"];

$sql = "SELECT Message_Id, Name, Brand, Model, Title, CreatedMessage, Viewed FROM Messages M
INNER JOIN Users U
ON U.User_Id = M.User_Id
INNER JOIN Cars C
ON C.License_Plate = M.License_Plate WHERE Receiver_Id = $id";

$total_pages = $con->query($sql)->num_rows;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$num_rows_on_page = 7;

$Messages = returnPaginationMessages($id, $page, $num_rows_on_page, $con);

include("../layout/header.php");
include("../layout/menu.php");
?>

<div class="container">
    <div class="row mt-4">
        <?php if (isset($Messages)) : ?>
            <?php foreach ($Messages as $message) : ?>
                <?php $date = explode(" ", $message["CreatedMessage"]); ?>
                <div class="card shadow-lg mb-2" style="width: 100%;">
                    <a class="a-cars" href="View_Message.php?id=<?= urlencode(base64_encode($message["Message_Id"])) ?>">
                        <div class="card-body" <?= $message["Viewed"] == 1 ? 'style="background-color: #dededebd;"' : "" ?>>
                            <div class="row">
                                <div class="col">
                                    <h4><strong><?= $message["Title"] ?></strong></h4>
                                    <div class="div-car-message rounded mt-2">
                                        <span class="font-weight-bold" style="font-size:25px"><?= $message["Brand"] . " " . $message["Model"] ?></span>
                                    </div>
                                </div>
                                <div class="col text-right">
                                    <p><?= $date[0] ?></p>
                                    <p><small>De: <?= $message["Name"] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="col mb-4" style="border-width:3px;border-style:dashed; color: lightgray">
                <br>
                <h3 class="text-center">
                    Ainda não recebeu nenhuma mensagem
                </h3>
                <br>
            </div>
        <?php endif ?>
    </div>

    <?php if (ceil($total_pages / $num_rows_on_page) > 0) : ?>
        <ul class="pagination mt-4">
            <?php if ($page > 1) : ?>
                <li class="prev"><a href="Messages.php?page=<?php echo $page - 1 ?>">Anterior</a></li>
            <?php endif; ?>

            <?php if ($page > 3) : ?>
                <li class="start"><a href="Messages.php?page=1">1</a></li>
                <li class="dots">...</li>
            <?php endif; ?>

            <?php if ($page - 2 > 0) : ?><li class="page"><a href="Messages.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
            <?php if ($page - 1 > 0) : ?><li class="page"><a href="Messages.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

            <li class="currentpage"><a href="Messages.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

            <?php if ($page + 1 < ceil($total_pages / $num_rows_on_page) + 1) : ?><li class="page"><a href="Messages.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
            <?php if ($page + 2 < ceil($total_pages / $num_rows_on_page) + 1) : ?><li class="page"><a href="Messages.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

            <?php if ($page < ceil($total_pages / $num_rows_on_page) - 2) : ?>
                <li class="dots">...</li>
                <li class="end"><a href="Messages.php?page=<?php echo ceil($total_pages / $num_rows_on_page) ?>"><?php echo ceil($total_pages / $num_rows_on_page) ?></a></li>
            <?php endif; ?>

            <?php if ($page < ceil($total_pages / $num_rows_on_page)) : ?>
                <li class="next"><a href="Messages.php?page=<?php echo $page + 1 ?>">Proximo</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include("../layout/footer.php"); ?>