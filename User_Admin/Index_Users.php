<?php
include_once("../Master.php");
?>
<!DOCTYPE html>

<body>
    <div class="container-fluid">
        <h3 class="text-dark mb-4" style="padding-top: 1.5rem">Gestão de Utilizadores</h3>
        <div class="row">
            <div class="col-md-1">

            </div>
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-control" name="SEL_Fuel">
                                    <option value="" disabled selected>Filtrar</option>
                                    <option value="1">Todos</option>
                                    <option value="2">Utilizadores</option>
                                    <option value="2">Empresários</option>
                                    <option value="2">Admins</option>
                                </select>
                            </div>
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-4">
                                <input placeholder="#Nome, #Email, #Telemovel" type="text" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div id="TabUsers">
                        <div class="card-body" style="border: 1px solid rgba(0, 0, 0, 0.1);">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">

            </div>
        </div>
    </div>
</body>

<script>
    function overload(str) {
        $.ajax({
            type: "GET",
            url: "../assets/usercard.php",
            data: {
                search: str
            },
            success: function(response) {
                $("#TabUsers").html(response);
            }
        });
    };
</script>

</html>