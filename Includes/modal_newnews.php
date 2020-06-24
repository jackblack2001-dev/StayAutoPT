<!-- Modal Create News -->
<div class="modal fade" id="ModalCreateNews" role="dialog">
    <div class="modal-dialog modal-lg">

        <form action="<?php echo ROOT_PATH ?>assets/stand_news.php" method="POST">
            <input type="hidden" name="standid" value="<?= $data["Stand_Id"] ?>">
            <input type="hidden" name="action" value="create">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Criar Nova Notícia</h4>
                </div>
                <div class="modal-body">
                    <h4>Título</h4>
                    <input class="form-control" type="text" name="title">
                    <hr>
                    <textarea name="text" id="ckeditor"></textarea>
                    <script>
                        CKEDITOR.replace('text');
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-outline-success float-right" type="submit" name="submit">Salvar <i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Modal  Update News -->
<div class="modal fade" id="ModalUpdateNews" role="dialog">

    <div class="modal-dialog modal-lg">
        <form action="<?php echo ROOT_PATH ?>assets/stand_news.php" method="POST">

            <input type="hidden" name="id_news" id="Id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Notícia</h4>
                </div>
                <div class="modal-body">
                    <h4>Título</h4>
                    <input class="form-control" type="text" name="title" id="UTitle">
                    <hr>
                    <textarea name="updatetext" id="UText"></textarea>
                    <script>
                        CKEDITOR.replace('updatetext');
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-outline-success float-right" type="submit" name="submit">Salvar <i class="fa fa-floppy-o"></i></button>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- Modal Select News -->
<div class="modal fade" id="ModalSelectNews" role="dialog">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row" style="width: 100%;">
                    <div class="col-md-8 col-sm-8">
                        <h4 class="modal-title">Selecionar noticia</h4>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <input class="form-control float-right" placeholder="Pesquisar" type="text" id="news_search">
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <table class="table" id="table_sel_edit_news">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Titulo</th>
                            <th scope="col">Data</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="table_news">
                        <tr>
                            <?php
                            $aux = true;
                            if (isset($news)) {
                                foreach ($news as $new) {
                                    $title = "";

                                    if (strlen($new["Title"]) > 15) {
                                        $title = substr($new["Title"], 0, 15) . "...";
                                    } else {
                                        $title = $new["Title"];
                                    }

                                    $date = explode(" ", $new["CreatedNews"]);

                                    echo "<tr>
                                                <th scope='row'>" . $title . "</th>
                                                <td>" . $date[0] . "<td>
                                                <td><button class='btn btn-outline-success float-right' onclick='UpdateNews(" . $new["News_Id"] . ")' data-dismiss='modal'>Editar</button></td>
                                                <td><button class='btn btn-outline-info float-right' onclick='GetNews(" . $new["News_Id"] . ")' data-dismiss='modal'>Selecionar</button></td>
                                            </tr>";
                                }
                            } else {
                                $aux = false;
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <?php
                if ($aux == false) {
                    echo '<div class="col" style="border-width:3px;border-style:dashed; color: lightgray">
                    <br>
                    <h3 class="text-center">
                        Ainda não inseriu nenhuma Notícia!
                    </h3>
                    <br>
                    </div>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>