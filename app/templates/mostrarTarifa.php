<?php ob_start(); ?>

<h1 class="text-center mt-2">Tarifas</h1>

<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#buscar">Buscar tarifa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#añadir">Añadir tarifa</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade show active" id="buscar">
            <br>
            <form action="index.php?ruta=listarTarifasFiltradas" method="POST">
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
            <form action="index.php?ruta=añadirTarifa" method="POST">
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
                    <label for="inputPrecio" class=" col-12 col-sm-2 col-form-label mt-3">Precio</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="number" class="form-control" id="inputPrecio" name="precio" min="1" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputHoraInicio" class=" col-12 col-sm-2 col-form-label mt-3">Hora de inicio</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="inputHoraInicio" name="horaInicio" required>
                    </div>
                    <label for="inputHoraFin" class=" col-12 col-sm-2 col-form-label mt-3">Hora de fin</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="inputHoraFin" name="horaFin" required>
                    </div>
                </div>
                <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                <?php if (isset($params['resultado3'])) { ?>
                    <input type="hidden" name="tipoPista" value="<?php echo $params['resultado3'] ?>">
                <?php } ?>
                <button type="submit" class="btn btn-secondary mt-3">Añadir</button>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 d-flex justify-content-center mt-4">
        <table id="example" class="table bg-light">
            <thead class="thead bg-secondary text-white">
                <tr>
                    <th class="text-center">Tipo de pista</th>
                    <th class="text-center">Hora inicio</th>
                    <th class="text-center">Hora fin</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <form action="index.php?ruta=actualizarTarifa" method="POST">
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['nombre'] ?></td>
                            <input type="hidden" name="tarifa" value="<?php echo $params['resultado'][$i]['id'] ?>">
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_inicio'] ?></td>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_fin'] ?></td>
                            <td><input type="text" name="precio" class="form-control text-center mx-auto" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['precio'] ?>" required></td>
                            <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                            <?php if (isset($params['resultado3'])) { ?>
                                <input type="hidden" name="tipoPista" value="<?php echo $params['resultado3'] ?>">
                            <?php } ?>
                            <td class="justify-content-center align-middle" style="width: 3rem;">
                                <input title="Actualizar" type="image" src="images/actualizar.png" id="actualizar" alt="actualizar" width="20" height="20" />
                            </td>
                        </form>
                        <td class="justify-content-center align-middle" style="width: 3rem;">
                            <form action="index.php?ruta=eliminarTarifa" method="POST">
                                <input type="hidden" name="idTarifa" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                <?php if (isset($params['resultado3'])) { ?>
                                    <input type="hidden" name="tipoPista" value="<?php echo $params['resultado3'] ?>">
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
                            <a class="page-link" href="index.php?ruta=listarTarifasFiltradas&pagina=<?php echo $params['paginaActual'] - 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarTarifa&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarTarifasFiltradas&pagina=<?php echo $params['paginaActual'] - 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarTarifa&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } ?>
                <?php for ($i = 0; $i < $params['paginas']; $i++) { ?>
                    <?php if ($params['paginaActual'] == $i + 1) { ?>
                        <?php if (isset($params['resultado3'])) { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=listarTarifasFiltradas&pagina=<?php echo $i + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarTarifa&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if (isset($params['resultado3'])) { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=listarTarifasFiltradas&pagina=<?php echo $i + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarTarifa&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($params['paginas'] == $params['paginaActual']) { ?>
                    <li class="page-item disabled">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarTarifasFiltradas&pagina=<?php echo $params['paginaActual'] + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarTarifa&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } ?>
                    </li>
                <?php } else { ?>
                    <li class="page-item">
                        <?php if (isset($params['resultado3'])) { ?>
                            <a class="page-link" href="index.php?ruta=listarTarifasFiltradas&pagina=<?php echo $params['paginaActual'] + 1 ?>&tipoPista=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        <?php } else { ?>
                            <a class="page-link" href="index.php?ruta=mostrarTarifa&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
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