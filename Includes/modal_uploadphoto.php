<div class="modal fade" id="ModalUpdateBanner" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="<?php echo ROOT_PATH ?>assets/photosubmit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="who" value="<?php echo $who ?>">
            <input type="hidden" name="type" value="banner">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Submeter Novo Banner</h4>
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

<div class="modal fade" id="ModalUpdateBadge" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form action="<?php echo ROOT_PATH ?>assets/photosubmit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="who" value="<?php echo $who ?>">
            <input type="hidden" name="type" value="badge">
            <input type="hidden" name="id" value="<?php echo $id ?>">

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Submeter Nova Foto</h4>
                </div>
                <div class="modal-body">
                    <input type="file" name="file">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-outline-success float-right" type="submit" name="submit" id="BTN_Save_Badge">Salvar <i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>