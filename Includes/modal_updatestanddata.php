<div class="modal fade" id="ModalUpdateStand" role="dialog">
    <div class="modal-dialog">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" value="<?= isset($data) ? $data["Stand_Id"] : 0 ?>" name="id_stand">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Atualizar informações do Stand</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="name"><strong>Nome do Stand</strong></label>
                        <input class="form-control" type="text" placeholder="<?php echo $data["Name"] ?>" name="name" id="name">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="adress"><strong>Morada</strong></label>
                                <input class="form-control" type="text" placeholder="<?php echo $data["Adress"] ?>" name="adress" id="adress">
                            </div>
                        </div>
                        <div class="col-md col-sm">
                            <div class="form-group">
                                <label for="phone"><strong>Telemóvel</strong></label>
                                <input class="form-control" type="tel" placeholder="<?php echo $data["Phone"] ?>" name="phone" id="phone">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="locality"><strong>Localidade</strong></label>
                        <select class="form-control" name="locality">
                            <?php if (isset($locations)) : ?>
                                <?php foreach ($locations as $location) : ?>
                                    <?php if (isset($stand_location) && $location["local_id"] == $stand_location["local_id"]) : ?>
                                        <option value="<?= $location["local_id"] ?>" selected><?= $location["name_location"] ?></option>
                                    <?php endif ?>
                                    <?php if (!isset($stand_location) || $location["local_id"] != $stand_location["local_id"]) : ?>
                                        <option value="<?= $location["local_id"] ?>"><?= $location["name_location"] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
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