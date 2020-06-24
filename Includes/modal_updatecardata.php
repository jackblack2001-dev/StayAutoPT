<div class="modal fade" id="ModalUpdateCar" role="dialog">
    <div class="modal-dialog modal-lg">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="redirect" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="id" value="<?= urldecode(base64_decode($_GET['id'])) ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atualizar informações do Carro</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="brand"><strong>Marca</strong></label>
                                <input class="form-control" type="text" placeholder="<?php echo $car["Brand"] ?>" name="brand" id="brand">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="model"><strong>Modelo</strong></label>
                                <input class="form-control" type="text" placeholder="<?php echo $car["Model"] ?>" name="model" id="model">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="price"><strong>Preço</strong></label>
                        <input class="form-control" type="number" placeholder="<?php echo $car["Price"] ?>" name="price" id="price">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="fuel"><strong>Combustivel</strong></label>
                                <select class="form-control" name="fuel">
                                    <option value="" disabled selected>Tipo de Combustivel</option>
                                    <option value="1">Gasolina</option>
                                    <option value="2">Diesel</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="gear"><strong>Trasmição</strong></label>
                                <select class="form-control" name="gear">
                                    <option value="" disabled selected default>Tipo de Transmição</option>
                                    <option value="1">Manual</option>
                                    <option value="2">Automático</option>
                                    <option value="3">CVT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="kms"><strong>Kilometros</strong></label>
                                <input class="form-control" type="text" placeholder="<?php echo $car["Kms"] ?>" name="kms" id="kms">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-4">
                                <label for="year"><strong>Ano</strong></label>
                                <input class="form-control" type="text" placeholder="<?php echo $car["Year"] ?>" name="year" id="year">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description"><strong>Descrição</strong></label>
                        <textarea name="description" class="form-control" rows="5"><?php echo $car["Description"] ?></textarea>
                        <script>
                            CKEDITOR.replace('description');
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-outline-success float-right" type="submit" name="submit">Salvar <i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>

<div class="modal fade" id="ModalSendMessage" role="dialog">
    <div class="modal-dialog modal-lg">

        <?php if (isset($_SESSION['Id'])) : ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="hidden" name="redirect" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="id_car" value="<?= urldecode(base64_decode($_GET['id'])) ?>">
                <input type="hidden" name="id_stand_owner" value="<?= $stand["User_Id"] ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Enviar Mensagem</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="title"><strong>Título</strong><sup style="color: red;">*</sup></label>
                                    <input class="form-control" type="text" name="title" id="title">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="chk_neg">
                                        <label class="form-check-label" for="chk_neg"><strong>Negociar Preço</strong></label>
                                    </div>
                                    <input class="form-control" type="number" placeholder="Montante €" name="price_neg" id="price_neg">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message"><strong>Mensagem</strong><sup style="color: red;">*</sup></label>
                            <textarea name="message" class="form-control" rows="5"></textarea>
                            <script>
                                CKEDITOR.replace('message');
                            </script>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-outline-success float-right" type="submit" name="submit">Enviar <i class="fa fa-send"></i></button>
                    </div>
                </div>
            </form>
        <?php endif ?>

        <?php if (!isset($_SESSION['Id'])) : ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Deve estar Logado para realizar esta ação</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        <h4><small>Para poder enviar uma mensagem ao dono deste carro, têm que efetuar o login primeiro</small></h4>
                    </p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-primary" href="../login.php">Login</a>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<div class="modal fade" id="ModalAddPhoto" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="<?php echo ROOT_PATH ?>assets/photosubmit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="who" value="car">
            <input type="hidden" name="type" value="update">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar foto</h4>
                </div>
                <div class="modal-body">
                    <input type="file" name="file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-outline-success float-right" type="submit" name="submit" id="BTN_Save_Banner">Salvar <i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>

<div id="ModalDeleteErrorNoData" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="error_title">Nenhuma Fotografia Selecionada</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <h4><small id="error_message">Selecione as fotografias para Eliminar</small></h4>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>

<div id="ModalDeleteErrorTooMutch" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="error_title">Impossivel Eliminar Fotografias</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <h4><small id="error_message">Têm que ficar obrigatoriamente com 3 fotografias</small></h4>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>

    </div>
</div>

<div id="ModalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="error_title">Eliminar Fotografias</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">
                    <h4><small id="error_message">Esta ação é Irreversível, deseja continuar?</small></h4>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="SeeChks()">Apagar <i class="fa fa-trash"></i></button>
            </div>
        </div>

    </div>
</div>

<div id="ModalSellCar" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="error_title">Finalizar Carro</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <h5><strong>Após vender o veiculo venha aqui para o finalizar</strong></h5>
                        <h5 class="mt-n2"><small>Tenha em mente que esta ação e irreversível</small></h5>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="chk_final">
                                <label class="form-check-label" for="chk_final"><strong>Outro Montante</strong></label>
                            </div>
                            <input class="form-control" type="number" placeholder="Montante €" name="price_final" id="price_final">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="SellCar()">Finalizar</i></button>
            </div>
        </div>

    </div>
</div>