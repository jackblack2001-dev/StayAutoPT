<?php
session_start();
define("ROOT_PATH", "http://" . $_SERVER["HTTP_HOST"] . "/StayAutoPT/");
define("INCLUDE_PATH", __DIR__);
include("../assets/role_checker.php");
include("../Public/config.php");
include("../assets/message_user.php");
include("../assets/user_info.php");

roleAdmin();

include("../layout/header.php");
include("../layout/menu.php");
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4" style="padding-top: 1.5rem">Gestão de Utilizadores</h3>
    <div class="row">
        <div class="col-md-1">

        </div>
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2 col-sm-4">
                            <select class="form-control" id="SEL_Type" onchange="overload('')">
                                <option value="3" selected>Todos</option>
                                <option value="1">Clientes</option>
                                <option value="2">Empresários</option>
                                <option value="0">Admins</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-3">

                        </div>
                        <div class="col-md-4 col-sm-5">
                            <input placeholder="#Nome, #Email, #Telemovel" type="text" class="form-control" onkeyup="overload(this.value)">
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                        </div>
                        <div class="col-md-3 col-sm-3 text-uppercase font-weight-bold text-xs">
                            Email
                        </div>
                        <div class="col-md-3 col-sm-3 text-uppercase font-weight-bold text-xs">
                            Nome
                        </div>
                        <div class="col-md-1 col-sm-2 text-uppercase font-weight-bold text-xs">
                            Perfil
                        </div>
                        <div class="col-md-2 col-sm-2 text-uppercase font-weight-bold text-xs">
                            Ultima Atualização
                        </div>
                        <div class="col-md-2 col-sm-2 text-center">
                        </div>
                    </div>
                    <hr style="border: 1px solid rgba(0, 0, 0, 0.2);">

                    <div id="TabUsers"></div>
                </div>

            </div>
        </div>
        <div class="col-md-1">

        </div>
    </div>
</div>

<?php include("../layout/footer.php") ?>

<script>
    $(document).ready(function() {
        overload("");
    });

    function overload(str) {
        $.ajax({
            type: "GET",
            url: "../assets/usercard.php",
            data: {
                type: $("#SEL_Type :selected").val(),
                search: str
            },
            success: function(response) {
                $("#TabUsers").html(response);
            }
        });
    };
</script>