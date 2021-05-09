<?php ob_start(); ?>

<h1 class="text-center">Mensajes</h1>

<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $enviado = $params['enviado'] !== NULL ? "" : "active" ?>" data-toggle="tab" href="#buscar">Buscar mensaje</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $enviado = $params['enviado'] !== NULL ? "active" : "" ?>" data-toggle="tab" href="#enviar">Enviar mensaje</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade <?php echo $enviado = $params['enviado'] !== NULL ? "" : "show active" ?>" id="buscar">
            <br>
            <form action="index.php?ruta=listarMensajesFiltrados" method="POST">
                <div class="form-group row">
                    <label for="inputMensajeArchivado" class="col-12 col-sm-2 col-form-label mt-3">Archivado</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputMensajeArchivado" class="form-control" name="archivado">
                            <?php if ($params['resultado3'][0] == 0) { ?>
                                <option value="0" selected>No</option>
                                <option value="1">Si</option>
                            <?php } elseif ($params['resultado3'][0] == 1) { ?>
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
        <div class="tab-pane fade <?php echo $enviado = $params['enviado'] !== NULL ? "show active" : "" ?>" id="enviar">
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
                        <textarea name="texto" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <?php if ($params['enviado'] !== NULL) { ?>
                    <div class="alert alert-success" role="alert">
                        Mensaje enviado con éxito
                    </div>
                <?php } ?>
                <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                <?php if (isset($params['resultado3'])) { ?>
                    <input type="hidden" name="archivadoP" value="<?php echo $params['resultado3'][0] ?>">
                    <input type="hidden" name="mensajeFechaP" value="<?php echo $params['resultado3'][1] ?>">
                <?php } ?>
                <button type="submit" class="btn btn-secondary mt-3" name="enviar">Enviar</button>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="row mb-2">
    <div class="col-12 d-flex justify-content-center">
        <table class="table bg-light">
            <thead class="thead bg-secondary text-white">
                <tr>
                    <th class="text-center">De</th>
                    <th class="text-center">Para</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Texto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['id_usuarioDe'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['id_usuarioPara'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['fecha'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['texto'] ?></td>
                        <td class="text-center align-middle">
                            <?php if ($params['resultado'][$i]['archivado'] == 0) { ?>
                                <form action="index.php?ruta=archivarMensaje" method="POST">
                                    <input type="hidden" name="mensaje" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                    <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                    <?php if (isset($params['resultado3'])) { ?>
                                        <input type="hidden" name="archivadoP" value="<?php echo $params['resultado3'][0] ?>">
                                        <input type="hidden" name="mensajeFechaP" value="<?php echo $params['resultado3'][1] ?>">
                                    <?php } ?>
                                    <button type="submit" class="btn btn-primary">Archivar</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row mb-5">
    <div class="col-12 d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-sm">
                <?php if ($params['paginaActual'] == 1) { ?>
                    <li class="page-item disabled">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarMensajesFiltrados&pagina=<?php echo $params['paginaActual'] - 1 ?>&archivado=<?php echo $params['resultado3'][0] ?>&mensajeFecha=<?php echo $params['resultado3'][1] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarMensajes&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarMensajesFiltrados&pagina=<?php echo $params['paginaActual'] - 1 ?>&archivado=<?php echo $params['resultado3'][0] ?>&mensajeFecha=<?php echo $params['resultado3'][1] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarMensajes&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php for ($i = 0; $i < $params['paginas']; $i++) { ?>
                    <?php if ($params['paginaActual'] == $i + 1) { ?>
                        <?php if (isset($params['resultado3'])) { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=listarMensajesFiltrados&pagina=<?php echo $i + 1 ?>&archivado=<?php echo $params['resultado3'][0] ?>&mensajeFecha=<?php echo $params['resultado3'][1] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarMensajes&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if (isset($params['resultado3'])) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=listarMensajesFiltrados&pagina=<?php echo $i + 1 ?>&archivado=<?php echo $params['resultado3'][0] ?>&mensajeFecha=<?php echo $params['resultado3'][1] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarMensajes&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($params['paginas'] == $params['paginaActual']) { ?>
                    <li class="page-item disabled">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarMensajesFiltrados&pagina=<?php echo $params['paginaActual'] + 1 ?>&archivado=<?php echo $params['resultado3'][0] ?>&mensajeFecha=<?php echo $params['resultado3'][1] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarMensajes&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarMensajesFiltrados&pagina=<?php echo $params['paginaActual'] + 1 ?>&archivado=<?php echo $params['resultado3'][0] ?>&mensajeFecha=<?php echo $params['resultado3'][1] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarMensajes&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>