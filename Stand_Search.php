<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/message_user.php");
include("assets/stand_user.php");

$locations = returnLocations($con);

$sql = "SELECT S.Stand_Id,Name, Banner_Name, L.name_location FROM Stands S 
INNER JOIN Stands_Badges SB
ON
SB.Stand_Id = S.Stand_Id
INNER JOIN Stands_Banners SBN
ON
SBN.Stand_Id = S.Stand_Id
INNER JOIN Locations L
ON
L.local_id = S.Locality
WHERE SB.State = 1 AND SBN.State = 1";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST["search"]) && $_POST["search"] != "") {
        $search = $_POST["search"];
        $sql .= " AND Name LIKE '%$search%'";
    }

    if (isset($_POST["locality"])) {
        $l = $_POST["locality"];
        $sql .= " AND L.local_id = '$l'";
    }
}

$total_pages = $con->query($sql)->num_rows;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$num_rows_on_page = 10;

$data = returnPaginationStands($sql, $page, $num_rows_on_page, $con);

include("layout/header.php");
include("layout/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row mt-4">
                <div class="card shadow" style="width: 100%;">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4>Pesquisa</h4>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-success float-right">Pesquisar <i class="fa fa-search fa-rotate-90"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Procurar</span>
                                        </div>
                                        <input type="text" placeholder="Nome do Stand" class="form-control" name="search">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <select class="form-control" name="locality">
                                            <option value="" selected disabled>Selecione uma Localidade</option>
                                            <?php if (isset($locations)) : ?>
                                                <?php foreach ($locations as $location) : ?>
                                                    <option value="<?= $location["local_id"] ?>"><?= $location["name_location"] ?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-4" id="cars_show">
                <?php if ($data != null) : ?>
                    <?php foreach ($data as $row) : ?>
                        <div class="card shadow-lg" style="width: 100%;">
                            <div class="card-body">
                                <div class="row">
                                    <img class="rounded" src="Public/Images/Stand_Banners/<?= $row["Banner_Name"] ?>" alt="" style="width: 250px; height: 170px;">
                                    <div class="col ml-2">
                                        <h4><strong><a class="a-cars" href="<?= ROOT_PATH ?>User_Stand/Stand_Profile.php?id=<?= $row["Stand_Id"] ?>"><?= $row["Name"] ?></a></strong></h4>
                                        <small><?= $row["name_location"] ?> <i class="fa fa-map-marker" style="color: red;"></i></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class="col mb-4" style="border-width:3px;border-style:dashed; color: lightgray">
                        <br>
                        <h3 class="text-center">
                            Não foram encontrados stands relacionados a pesquisa
                        </h3>
                        <br>
                    </div>
                <?php endif ?>
            </div>

            <?php if (ceil($total_pages / $num_rows_on_page) > 0) : ?>
                <ul class="pagination mt-4">
                    <?php if ($page > 1) : ?>
                        <li class="prev"><a href="Stand_Search.php?page=<?php echo $page - 1 ?>">Anterior</a></li>
                    <?php endif; ?>

                    <?php if ($page > 3) : ?>
                        <li class="start"><a href="Stand_Search.php?page=1">1</a></li>
                        <li class="dots">...</li>
                    <?php endif; ?>

                    <?php if ($page - 2 > 0) : ?><li class="page"><a href="Stand_Search.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                    <?php if ($page - 1 > 0) : ?><li class="page"><a href="Stand_Search.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                    <li class="currentpage"><a href="Stand_Search.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                    <?php if ($page + 1 < ceil($total_pages / $num_rows_on_page) + 1) : ?><li class="page"><a href="Stand_Search.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                    <?php if ($page + 2 < ceil($total_pages / $num_rows_on_page) + 1) : ?><li class="page"><a href="Stand_Search.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                    <?php if ($page < ceil($total_pages / $num_rows_on_page) - 2) : ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="Stand_Search.php?page=<?php echo ceil($total_pages / $num_rows_on_page) ?>"><?php echo ceil($total_pages / $num_rows_on_page) ?></a></li>
                    <?php endif; ?>

                    <?php if ($page < ceil($total_pages / $num_rows_on_page)) : ?>
                        <li class="next"><a href="Stand_Search.php?page=<?php echo $page + 1 ?>">Proximo</a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>