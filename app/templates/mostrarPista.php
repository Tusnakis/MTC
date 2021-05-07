<?php ob_start(); ?>

<h1 class="text-center mt-2">Pistas</h1>

<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#buscar">Buscar pista</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#añadir">Añadir pista</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade show active" id="buscar">
            <br>
            <form action="index.php?ruta=listarPistaFiltradas" method="POST">
                <div class="form-group row">
                    <label for="inputTipoPista" class="col-12 col-sm-2 col-form-label mt-3">Tipo de pista</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputTipoPista" class="form-control" name="tipoPista">
                            <?php for ($i = 0; $i < count($params['resultado2']); $i++) { ?>
                                <?php if ($params['resultado2'][$i]['id'] == $params['resultado3']) { ?>
                                    <option value="<?php echo $params['resultado2'][$i]['id'] ?>" selected><?php echo ucwords($params['resultado2'][$i]['nombre']) ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $params['resultado2'][$i]['id'] ?>"><?php echo ucwords($params['resultado2'][$i]['nombre']) ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
            </form>
        </div>
        <div class="tab-pane fade" id="añadir">
            <br>
            <form action="index.php?ruta=añadirPista" method="POST">
                <div class="form-group row">
                    <label for="inputTipoPista" class="col-12 col-sm-2 col-form-label mt-3">Tipo de pista</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputTipoPista" class="form-control" name="tipoPista">
                            <?php for ($i = 0; $i < count($params['resultado2']); $i++) { ?>
                                <?php if ($params['resultado2'][$i]['id'] == $params['resultado3']) { ?>
                                    <option value="<?php echo $params['resultado2'][$i]['id'] ?>" selected><?php echo ucwords($params['resultado2'][$i]['nombre']) ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $params['resultado2'][$i]['id'] ?>"><?php echo ucwords($params['resultado2'][$i]['nombre']) ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNumPista" class=" col-12 col-sm-2 col-form-label mt-3">Número de pista</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="inputNumPista" name="numPista" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Añadir</button>
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
                    <th class="text-center">Tipo de pista</th>
                    <th class="text-center">Número de pista</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <form action="index.php?ruta=actualizarPista" method="POST">
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['nombre'] ?></td>
                            <input type="hidden" name="pista" value="<?php echo $params['resultado'][$i]['id'] ?>">
                            <td><input type="text" name="numPista" class="form-control text-center mx-auto" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['num_pista'] ?>" required></td>
                            <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                            <?php if (isset($params['resultado3'])) { ?>
                                <input type="hidden" name="tipoPistaP" value="<?php echo $params['resultado3'] ?>">
                            <?php } ?>
                            <td class="justify-content-center align-middle" style="width: 3rem;">
                                <input title="Actualizar" type="image" src="images/actualizar.png" id="actualizar" alt="actualizar" width="20" height="20" />
                            </td>
                        </form>
                        <td class="justify-content-center align-middle" style="width: 3rem;">
                            <form id="eliminarPista" action="index.php?ruta=eliminarPista" method="POST">
                                <input type="hidden" name="idPista" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                <input type="hidden" class="tipoPista" value="<?php echo $params['resultado'][$i]['nombre'] ?>">
                                <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                <?php if (isset($params['resultado3'])) { ?>
                                    <input type="hidden" name="tipoPistaP" value="<?php echo $params['resultado3'] ?>">
                                <?php } ?>
                                <input title="Eliminar" type="image" src="images/eliminar.png" id="eliminar" alt="eliminar" width="20" height="20" />
                            </form>
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
                            <a class="page-link" href="index.php?ruta=listarPistaFiltradas&pagina=<?php echo $params['paginaActual'] - 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarPista&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarPistaFiltradas&pagina=<?php echo $params['paginaActual'] - 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarPista&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php for ($i = 0; $i < $params['paginas']; $i++) { ?>
                    <?php if ($params['paginaActual'] == $i + 1) { ?>
                        <?php if (isset($params['resultado3'])) { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=listarPistaFiltradas&pagina=<?php echo $i + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarPista&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if (isset($params['resultado3'])) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=listarPistaFiltradas&pagina=<?php echo $i + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarPista&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($params['paginas'] == $params['paginaActual']) { ?>
                    <li class="page-item disabled">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarPistaFiltradas&pagina=<?php echo $params['paginaActual'] + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarPista&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarPistaFiltradas&pagina=<?php echo $params['paginaActual'] + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarPista&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
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

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>