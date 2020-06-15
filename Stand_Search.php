<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("Public/config.php");
include("assets/user_info.php");
include("assets/stand_user.php");

$total_pages = $con->query("SELECT * FROM Stands")->num_rows;

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

$num_rows_on_page = 5;

$data = returnPaginationStands($page, $num_rows_on_page, $con);

include("layout/header.php");
include("layout/menu.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <!-- divisoria -->
        </div>
        <div class="col-md-8">
            <!-- Area do ricardo -->
            <div class="row mt-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Filtros</h4>
                    </div>
                    <div class="card-body">
                    </div>
                </div>
            </div>
            <div class="row mt-4" id="cars_show">
                <?php foreach ($data as $row) : ?>
                    <div class="card shadow-lg" style="width: 100%;">
                        <div class="card-body">
                            <div class="row">
                                <img class="rounded" src="Public/Images/Stand_Banners/<?=$row["Banner_Name"]?>" alt="" style="width: 250px; height: 170px;">
                                <div class="col ml-2">
                                    <h4><strong><?= $row["Name"] ?></strong></h4>
                                    <small>Viseu <i class="fa fa-map-marker" style="color: red;"></i></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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
            <!-- divisoria -->
        </div>
    </div>
</div>

<?php include("layout/footer.php"); ?>