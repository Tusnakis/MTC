<?php ob_start(); ?>

<h1 class="text-center">Mensajes</h1>

<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#buscar">Buscar mensaje</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#enviar">Enviar mensaje</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade show active" id="buscar">
            <br>
            <form action="index.php?ruta=listarMensajesFiltrados" method="POST">
                <div class="form-group row">
                    <label for="inputMensajeArchivado" class="col-12 col-sm-2 col-form-label mt-3">Archivado</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputMensajeArchivado" class="form-control" name="archivado">
                            <?php if($params['resultado3'][0] == 0) { ?>
                                <option value="0" selected>No</option>
                                <option value="1">Si</option>
                            <?php } elseif($params['resultado3'][0] == 1) { ?>
                                <option value="0">No</option>
                                <option value="1" selected>Si</option>
                            <?php } else { ?>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            <?php } ?>
                        </select>
                    </div>
                    <label for="inputMensajeFecha" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="date" class="form-control" id="mensajeFecha" name="mensajeFecha" value="<?php echo $params['resultado3'][1] ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
            </form>
        </div>
        <div class="tab-pane fade" id="enviar">
            <br>
            <form action="index.php?ruta=enviarMensaje" method="POST">
                <div class="form-group row">
                    <label for="inputUsuarioPara" class="col-12 col-sm-2 col-form-label mt-3">Destinatario</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="usuarioPara" class="form-control" name="usuarioPara">
                            <?php for ($i = 0; $i < count($params['resultado2']); $i++) { ?>
                                <option value="<?php echo $params['resultado2'][$i]['usuario'] ?>"><?php echo $params['resultado2'][$i]['usuario'] ?> - <?php echo $params['resultado2'][$i]['rol'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="textareaTexto" class=" col-12 col-sm-2 col-form-label mt-3">Mensaje</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <textarea name="texto" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Enviar</button>
            </form>
        </div>
    </div>
</div>
<hr>
<?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
    <div class="row mb-5">
        <div class="col-12 d-flex justify-content-center my-4">
            <div class="card bg-light" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title text-center">De: <?php echo $params['resultado'][$i]['id_usuarioDe'] ?></h5>
                    <h5 class="card-title text-center">Para: <?php echo $params['resultado'][$i]['id_usuarioPara'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted text-center"><?php echo $params['resultado'][$i]['fecha'] ?></h6>
                    <hr>
                    <p class="card-text text-center"><?php echo $params['resultado'][$i]['texto'] ?></p>
                    <?php if ($params['resultado'][$i]['archivado'] == 0) { ?>
                        <div class="container">
                            <div class="row">
                                <div class="col text-center">
                                    <form action="index.php?ruta=archivarMensaje" method="POST">
                                        <input type="hidden" name="mensaje" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                        <input type="submit" class="btn btn-primary" value="Archivar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>