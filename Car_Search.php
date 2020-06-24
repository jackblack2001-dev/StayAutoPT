<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/message_user.php");
include('assets/stand_user.php');
include("assets/car_stand.php");

$locations = returnLocations($con);

$sql = "SELECT License_Plate, Card_Image, Brand, Model, Type_Fuel, Type_Gear, Kms, Price, Year, L.name_location FROM Cars C
INNER JOIN Stands S
ON S.Stand_Id = C.Stand_Id
INNER JOIN Locations L
ON L.local_id = S.Locality WHERE State = 1";

$yf = $yt = $pf = $pt = $kf = $kt = $f = $g = $l = null;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["search"]) && $_POST["search"] != "") {
        $search = $_POST["search"];
        $sql .= " AND Brand LIKE '%$search%' OR Model LIKE '%$search%'";
    }

    if (isset($_POST["year_from"])) {
        $yf = $_POST["year_from"];
        $sql .= " AND Year >= '$yf'";
    }

    if (isset($_POST["year_to"])) {
        $yt = $_POST["year_to"];
        $sql .= " AND Year <= '$yt'";
    }

    if (isset($_POST["price_from"]) && $_POST["price_from"] != "") {
        $pf = $_POST["price_from"];
        $sql .= " AND Price >= '$pf'";
    }

    if (isset($_POST["price_to"]) && $_POST["price_to"] != "") {
        $pt = $_POST["price_to"];
        $sql .= " AND Price <= '$pt'";
    }

    if (isset($_POST["kms_from"]) && $_POST["kms_from"] != "") {
        $kf = $_POST["kms_from"];
        $sql .= " AND Kms >= '$kf'";
    }

    if (isset($_POST["kms_to"]) && $_POST["kms_to"] != "") {
        $kt = $_POST["kms_to"];
        $sql .= " AND Kms <= '$kt'";
    }

    if (isset($_POST["fuel"])) {
        $f = $_POST["fuel"];
        $sql .= " AND Type_Fuel = '$f'";
    }

    if (isset($_POST["gear"])) {
        $g = $_POST["gear"];
        $sql .= " AND Type_Gear = '$g'";
    }

    if (isset($_POST["locality"])) {
        $l = $_POST["locality"];
        $sql .= " AND L.local_id = '$l'";
    }

    RecordSearch($yf, $yt, $pf, $pt, $kf, $kt, $f, $g, $l, $con);
}

$total_pages = $con->query($sql)->num_rows;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$num_rows_on_page = 15;

$data = returnPaginationCars($sql, $page, $num_rows_on_page, $con);

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
                                        <input type="text" placeholder="Marca ou Modelo" class="form-control" name="search">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Ano de</span>
                                        </div>
                                        <select class="form-control" name="year_from">
                                            <option value="" disabled selected>Ano</option>
                                            <?php for ($i = 1920; $i < date("Y") + 1; $i++) : ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor ?>
                                        </select>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Até</span>
                                        </div>
                                        <select class="form-control" name="year_to">
                                            <option value="" disabled selected>Ano</option>
                                            <?php for ($i = 1920; $i < date("Y") + 1; $i++) : ?>
                                                <option value="<?= $i ?>"><?= $i ?></option>
                                            <?php endfor ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Preço de </span>
                                        </div>
                                        <input type="text" class="form-control" name="price_from">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Até</span>
                                        </div>
                                        <input type="text" class="form-control" name="price_to">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Kms de </span>
                                        </div>
                                        <input type="text" class="form-control" name="kms_from">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="">Até</span>
                                        </div>
                                        <input type="text" class="form-control" name="kms_to">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <div class="input-group">
                                        <select class="form-control" name="fuel">
                                            <option value="" disabled selected>Tipo de Combustivel</option>
                                            <option value="1">Gasolina</option>
                                            <option value="2">Diesel</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <select class="form-control" name="gear">
                                            <option value="" disabled selected default>Tipo de Transmição</option>
                                            <option value="1">Manual</option>
                                            <option value="2">Automático</option>
                                            <option value="3">CVT</option>
                                        </select>
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
                                    <img class="rounded" src="Public/Images/Car_Photos/<?= $row["Card_Image"] ?>" alt="" style="width: 250px; height: 170px;">
                                    <div class="col ml-2">
                                        <h4><strong><a class="a-cars" href="<?= ROOT_PATH ?>User_Stand/Car_Profile.php?id=<?= urlencode(base64_encode($row["License_Plate"])) ?>"><?= $row["Model"] ?></a></strong></h4>
                                        <h5><small><?= $row["Type_Fuel"] ?> - <?= $row["Type_Gear"] ?> - <?= $row["Kms"] ?> Km</small></h5>
                                        <small><?= $row["name_location"] ?> <i class="fa fa-map-marker" style="color: red;"></i></small>
                                    </div>
                                    <div class="col">
                                        <div class="float-right">
                                            <h2 class="mb-4"><?= $row["Price"] ?> <i class="fa fa-euro"></i></h2>
                                            <h5 class="float-right"><small><?= $row["Year"] ?></small></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else : ?>
                    <div class="col mb-4" style="border-width:3px;border-style:dashed; color: lightgray">
                        <br>
                        <h3 class="text-center">
                            Não foram encontrados carros relacionados a pesquisa
                        </h3>
                        <br>
                    </div>
                <?php endif ?>
            </div>

            <?php if (ceil($total_pages / $num_rows_on_page) > 0) : ?>
                <ul class="pagination mt-4">
                    <?php if ($page > 1) : ?>
                        <li class="prev"><a href="Car_Search.php?page=<?php echo $page - 1 ?>">Anterior</a></li>
                    <?php endif; ?>

                    <?php if ($page > 3) : ?>
                        <li class="start"><a href="Car_Search.php?page=1">1</a></li>
                        <li class="dots">...</li>
                    <?php endif; ?>

                    <?php if ($page - 2 > 0) : ?><li class="page"><a href="Car_Search.php?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                    <?php if ($page - 1 > 0) : ?><li class="page"><a href="Car_Search.php?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                    <li class="currentpage"><a href="Car_Search.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                    <?php if ($page + 1 < ceil($total_pages / $num_rows_on_page) + 1) : ?><li class="page"><a href="Car_Search.php?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                    <?php if ($page + 2 < ceil($total_pages / $num_rows_on_page) + 1) : ?><li class="page"><a href="Car_Search.php?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                    <?php if ($page < ceil($total_pages / $num_rows_on_page) - 2) : ?>
                        <li class="dots">...</li>
                        <li class="end"><a href="Car_Search.php?page=<?php echo ceil($total_pages / $num_rows_on_page) ?>"><?php echo ceil($total_pages / $num_rows_on_page) ?></a></li>
                    <?php endif; ?>

                    <?php if ($page < ceil($total_pages / $num_rows_on_page)) : ?>
                        <li class="next"><a href="Car_Search.php?page=<?php echo $page + 1 ?>">Proximo</a></li>
                    <?php endif; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>