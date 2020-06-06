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
                <?php
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
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>