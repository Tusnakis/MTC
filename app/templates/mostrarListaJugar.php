<?php ob_start(); ?>

<h1 class="text-center pt-5">Lista jugadores</h1>

<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $apuntado = $params['apuntado'] !== NULL ? "" : "active" ?>" data-toggle="tab" href="#buscar">Buscar jugador</a>
        </li>
        <?php if ($_SESSION['rol'] == 'user') { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $apuntado = $params['apuntado'] !== NULL ? "active" : "" ?>" data-toggle="tab" href="#apuntarse">Apuntarse a la lista</a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade <?php echo $apuntado = $params['apuntado'] !== NULL ? "" : "show active" ?>" id="buscar">
            <br>
            <form action="index.php?ruta=listarUsuariosListaFiltrados" method="POST">
                <div class="form-group row">
                    <label for="fechaReserva" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="date" class="form-control" id="fechaReserva" name="fecha" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d", strtotime('+ 1 week')) ?>" value="<?php if (!empty($params['resultado2'])) {
                                                                                                                                                                                                        echo $params['resultado2'];
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo date("Y-m-d");
                                                                                                                                                                                                    } ?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputCategoria" class="col-12 col-sm-2 col-form-label mt-3">Categoría</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputCategoria" class="form-control" name="categoria">
                            <option value="1" <?php echo $categoria = $params['resultado3'] == 1 ? "selected" : "" ?>>1</option>
                            <option value="2" <?php echo $categoria = $params['resultado3'] == 2 ? "selected" : "" ?>>2</option>
                            <option value="3" <?php echo $categoria = $params['resultado3'] == 3 ? "selected" : "" ?>>3</option>
                            <option value="4" <?php echo $categoria = $params['resultado3'] == 4 ? "selected" : "" ?>>4</option>
                            <option value="5" <?php echo $categoria = $params['resultado3'] == 5 ? "selected" : "" ?>>5</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
            </form>
        </div>
        <?php if ($_SESSION['rol'] == 'user') { ?>
            <div class="tab-pane fade <?php echo $apuntado = $params['apuntado'] !== NULL ? "show active" : "" ?>" id="apuntarse">
                <br>
                <form action="index.php?ruta=añadirListaJugar" method="POST">
                    <div class="form-group row">
                        <label for="fechaReserva" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <input type="date" class="form-control" id="fechaReserva" name="fecha" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d", strtotime('+ 1 week')) ?>" value="<?php if (!empty($params['resultado4'])) {
                                                                                                                                                                                                            echo $params['resultado4'][0];
                                                                                                                                                                                                        } else {
                                                                                                                                                                                                            echo date("Y-m-d");
                                                                                                                                                                                                        } ?>" required>
                        </div>
                        <label for="inputCategoria" class="col-12 col-sm-2 col-form-label mt-3">Categoría</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="inputCategoria" class="form-control" name="categoria">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputHoraInicio" class="col-12 col-sm-2 col-form-label mt-3">Hora inicio</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="inputHoraInicio" class="form-control" name="horaInicio">
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                        <label for="inputHoraFin" class="col-12 col-sm-2 col-form-label mt-3">Hora fin</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="inputHoraFin" class="form-control" name="horaFin">
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                    <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                        <input type="hidden" name="fechaP" value="<?php echo $params['resultado2'] ?>">
                        <input type="hidden" name="categoriaP" value="<?php echo $params['resultado3'] ?>">
                    <?php } ?>
                    <?php if ($params['apuntado'] !== NULL) { ?>
                        <div class="alert alert-<?php echo $aviso ?>" role="alert">
                            <?php echo $params['apuntado'] ?>
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-secondary mt-3" name="apuntarse">Apuntarse</button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<hr>
<div class="row <?php echo $sinPaginas = $params['paginas'] <= 1 ? "mb-5" : "" ?>">
    <div class="col-12 d-flex justify-content-center my-4">
        <table class="table bg-light">
            <thead class="thead bg-secondary text-white">
                <tr>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Organizador</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Desde</th>
                    <th class="text-center">Hasta</th>
                    <th class="text-center">Categoría</th>
                    <th class="text-center">Fecha inicio</th>
                    <th class="text-center">T. de pista</th>
                    <th class="text-center">Pista</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <?php if (date('H') < str_replace(':00', '', $params['resultado'][$i]['hora_hasta']) && date('Y-m-d') == $params['resultado2']) { ?>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['id_usuario_a'] ?></td>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['id_usuario_e'] ?></td>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['fecha'] ?></td>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_desde'] ?></td>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_hasta'] ?></td>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['categoria'] ?></td>
                            <?php if (isset($params['resultado'][$i]['hora_inicio'])) { ?>
                                <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_inicio'] ?></td>
                                <?php for ($y = 0; $y < count($params['tipoPista']); $y++) { ?>
                                    <?php if ($params['tipoPista'][$y]['id'] == $params['resultado'][$i]['id_tipo_pista']) { ?>
                                        <td class="text-center align-middle"><?php echo $params['tipoPista'][$y]['nombre'] ?></td>
                                    <?php } ?>
                                <?php } ?>
                                <td class="text-center align-middle"><?php echo $params['resultado'][$i]['num_pista'] ?></td>
                            <?php } else { ?>
                                <?php if ($_SESSION['rol'] == 'user') { ?>
                                    <form action="index.php?ruta=elegirUsuarioLista" method="POST">
                                    <?php } ?>
                                    <?php $horaDesde = intval(str_replace(":00", "", $params['resultado'][$i]['hora_desde'])); ?>
                                    <?php $horaHasta = intval(str_replace(":00", "", $params['resultado'][$i]['hora_hasta'])); ?>
                                    <td class="text-center align-middle">
                                        <select name="horaInicio" <?php echo $siAdmin = $_SESSION['rol'] == 'admin' ? "disabled" : "" ?>>
                                            <?php for ($x = $horaDesde; $x <= $horaHasta; $x++) { ?>
                                                <?php if ($x < 10) { ?>
                                                    <?php if ("0" . $x > date('H') && $params['resultado2'] == date('Y-m-d')) { ?>
                                                        <option value="<?php echo "0" . $x . ":00" ?>"><?php echo "0" . $x . ":00" ?></option>
                                                    <?php } elseif ($params['resultado2'] > date('Y-m-d')) { ?>
                                                        <option value="<?php echo "0" . $x . ":00" ?>"><?php echo "0" . $x . ":00" ?></option>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($x > date('H') && $params['resultado2'] == date('Y-m-d')) { ?>
                                                        <option value="<?php echo $x . ":00" ?>"><?php echo $x . ":00" ?></option>
                                                    <?php } elseif ($params['resultado2'] > date('Y-m-d')) { ?>
                                                        <option value="<?php echo $x . ":00" ?>"><?php echo $x . ":00" ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <?php if (!isset($params['resultado'][$i]['id_tipo_pista'])) { ?>
                                        <td class="text-center align-middle">
                                            <select name="tipoPista" <?php echo $siAdmin = $_SESSION['rol'] == 'admin' ? "disabled" : "" ?>>
                                                <?php for ($y = 0; $y < count($params['tipoPista']); $y++) { ?>
                                                    <option value="<?php echo $params['tipoPista'][$y]['id'] ?>"><?php echo $params['tipoPista'][$y]['nombre'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    <?php } ?>
                                    <?php if (!isset($params['resultado'][$i]['num_pista'])) { ?>
                                        <td class="text-center align-middle">
                                            <select name="numPista" <?php echo $siAdmin = $_SESSION['rol'] == 'admin' ? "disabled" : "" ?>>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($_SESSION['rol'] == 'user') { ?>
                                    <td class="text-center">
                                        <?php if (!isset($params['resultado'][$i]['id_usuario_e']) && !isset($params['resultado'][$i]['hora_inicio']) && $params['resultado'][$i]['id_usuario_a'] <> $_SESSION['usuario']) { ?>
                                            <input type="hidden" name="id" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                            <input type="hidden" name="usuarioA" value="<?php echo $params['resultado'][$i]['id_usuario_a'] ?>">
                                            <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                                <input type="hidden" name="fechaP" value="<?php echo $params['resultado2'] ?>">
                                                <input type="hidden" name="categoriaP" value="<?php echo $params['resultado3'] ?>">
                                            <?php } ?>
                                            <input type="submit" class="btn btn-info" value="Elegir">
                                    </form>
                                <?php } elseif (isset($params['resultado'][$i]['id_usuario_e']) && $params['resultado'][$i]['hora_inicio']) { ?>
                                    Jugador elegido
                                <?php } else { ?>
                                    <input type="submit" class="btn btn-info" value="Elegir" disabled>
                                <?php } ?>
                                </td>
                            <?php } ?>
                            <?php if ($_SESSION['rol'] == 'admin') { ?>
                                <td class="justify-content-center align-middle" style="width: 3rem;">
                                    <form action="index.php?ruta=eliminarUsuarioLista" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                        <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                        <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                            <input type="hidden" name="fechaP" value="<?php echo $params['resultado2'] ?>">
                                            <input type="hidden" name="categoriaP" value="<?php echo $params['resultado3'] ?>">
                                        <?php } ?>
                                        <input title="Eliminar" type="image" src="images/eliminar.png" id="eliminar" alt="eliminar" width="20" height="20" />
                                    </form>
                                </td>
                            <?php } ?>
                    </tr>
                <?php } elseif ($params['resultado2'] > date('Y-m-d')) { ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['id_usuario_a'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['id_usuario_e'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['fecha'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_desde'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_hasta'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['categoria'] ?></td>
                        <?php if (isset($params['resultado'][$i]['hora_inicio'])) { ?>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_inicio'] ?></td>
                            <?php for ($y = 0; $y < count($params['tipoPista']); $y++) { ?>
                                <?php if ($params['tipoPista'][$y]['id'] == $params['resultado'][$i]['id_tipo_pista']) { ?>
                                    <td class="text-center align-middle"><?php echo $params['tipoPista'][$y]['nombre'] ?></td>
                                <?php } ?>
                            <?php } ?>
                            <td class="text-center align-middle"><?php echo $params['resultado'][$i]['num_pista'] ?></td>
                        <?php } else { ?>
                            <?php if ($_SESSION['rol'] == 'user') { ?>
                                <form action="index.php?ruta=elegirUsuarioLista" method="POST">
                                <?php } ?>
                                <?php $horaDesde = intval(str_replace(":00", "", $params['resultado'][$i]['hora_desde'])); ?>
                                <?php $horaHasta = intval(str_replace(":00", "", $params['resultado'][$i]['hora_hasta'])); ?>
                                <td class="text-center align-middle">
                                    <select name="horaInicio" <?php echo $siAdmin = $_SESSION['rol'] == 'admin' ? "disabled" : "" ?>>
                                        <?php for ($x = $horaDesde; $x <= $horaHasta; $x++) { ?>
                                            <?php if ($x < 10) { ?>
                                                <?php if ("0" . $x > date('H') && $params['resultado2'] == date('Y-m-d')) { ?>
                                                    <option value="<?php echo "0" . $x . ":00" ?>"><?php echo "0" . $x . ":00" ?></option>
                                                <?php } elseif ($params['resultado2'] > date('Y-m-d')) { ?>
                                                    <option value="<?php echo "0" . $x . ":00" ?>"><?php echo "0" . $x . ":00" ?></option>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($x > date('H') && $params['resultado2'] == date('Y-m-d')) { ?>
                                                    <option value="<?php echo $x . ":00" ?>"><?php echo $x . ":00" ?></option>
                                                <?php } elseif ($params['resultado2'] > date('Y-m-d')) { ?>
                                                    <option value="<?php echo $x . ":00" ?>"><?php echo $x . ":00" ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </td>
                                <?php if (!isset($params['resultado'][$i]['id_tipo_pista'])) { ?>
                                    <td class="text-center align-middle">
                                        <select name="tipoPista" <?php echo $siAdmin = $_SESSION['rol'] == 'admin' ? "disabled" : "" ?>>
                                            <?php for ($y = 0; $y < count($params['tipoPista']); $y++) { ?>
                                                <option value="<?php echo $params['tipoPista'][$y]['id'] ?>"><?php echo $params['tipoPista'][$y]['nombre'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                <?php } ?>
                                <?php if (!isset($params['resultado'][$i]['num_pista'])) { ?>
                                    <td class="text-center align-middle">
                                        <select name="numPista" <?php echo $siAdmin = $_SESSION['rol'] == 'admin' ? "disabled" : "" ?>>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </td>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($_SESSION['rol'] == 'user') { ?>
                                <td class="text-center">
                                    <?php if (!isset($params['resultado'][$i]['id_usuario_e']) && !isset($params['resultado'][$i]['hora_inicio']) && $params['resultado'][$i]['id_usuario_a'] <> $_SESSION['usuario']) { ?>
                                        <input type="hidden" name="id" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                        <input type="hidden" name="usuarioA" value="<?php echo $params['resultado'][$i]['id_usuario_a'] ?>">
                                        <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                        <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                            <input type="hidden" name="fechaP" value="<?php echo $params['resultado2'] ?>">
                                            <input type="hidden" name="categoriaP" value="<?php echo $params['resultado3'] ?>">
                                        <?php } ?>
                                        <input type="submit" class="btn btn-info" value="Elegir">
                                </form>
                            <?php } elseif (isset($params['resultado'][$i]['id_usuario_e']) && $params['resultado'][$i]['hora_inicio']) { ?>
                                Jugador elegido
                            <?php } else { ?>
                                <input type="submit" class="btn btn-info" value="Elegir" disabled>
                            <?php } ?>
                            </td>
                        <?php } ?>
                        <?php if ($_SESSION['rol'] == 'admin') { ?>
                            <td class="justify-content-center align-middle" style="width: 3rem;">
                                <form action="index.php?ruta=eliminarUsuarioLista" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                    <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                    <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                        <input type="hidden" name="fechaP" value="<?php echo $params['resultado2'] ?>">
                                        <input type="hidden" name="categoriaP" value="<?php echo $params['resultado3'] ?>">
                                    <?php } ?>
                                    <input title="Eliminar" type="image" src="images/eliminar.png" id="eliminar" alt="eliminar" width="20" height="20" />
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php if ($params['paginas'] > 1) { ?>
    <div class="row mb-5">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm">
                    <?php if ($params['paginaActual'] == 1) { ?>
                        <li class="page-item disabled">
                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                <a class="page-link" href="index.php?ruta=listarUsuariosListaFiltrados&pagina=<?php echo $params['paginaActual'] - 1 ?>&fecha=<?php echo $params['resultado2'] ?>&categoria=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarListaJugar&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                <a class="page-link" href="index.php?ruta=listarUsuariosListaFiltrados&pagina=<?php echo $params['paginaActual'] - 1 ?>&fecha=<?php echo $params['resultado2'] ?>&categoria=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarListaJugar&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php } ?>
                    <?php for ($i = 0; $i < $params['paginas']; $i++) { ?>
                        <?php if ($params['paginaActual'] == $i + 1) { ?>
                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                <li class="page-item active"><a class="page-link" href="index.php?ruta=listarUsuariosListaFiltrados&pagina=<?php echo $i + 1 ?>&fecha=<?php echo $params['resultado2'] ?>&categoria=<?php echo $params['resultado3'] ?>"><?php echo $i + 1 ?></a></li>
                            <?php } else { ?>
                                <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarListaJugar&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?ruta=listarUsuariosListaFiltrados&pagina=<?php echo $i + 1 ?>&fecha=<?php echo $params['resultado2'] ?>&categoria=<?php echo $params['resultado3'] ?>"><?php echo $i + 1 ?></a></li>
                            <?php } else { ?>
                                <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarListaJugar&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($params['paginas'] == $params['paginaActual']) { ?>
                        <li class="page-item disabled">
                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                <a class="page-link" href="index.php?ruta=listarUsuariosListaFiltrados&pagina=<?php echo $params['paginaActual'] + 1 ?>&fecha=<?php echo $params['resultado2'] ?>&categoria=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarListaJugar&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <?php if (isset($params['resultado2']) && isset($params['resultado3'])) { ?>
                                <a class="page-link" href="index.php?ruta=listarUsuariosListaFiltrados&pagina=<?php echo $params['paginaActual'] + 1 ?>&fecha=<?php echo $params['resultado2'] ?>&categoria=<?php echo $params['resultado3'] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarListaJugar&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
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
<?php } ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>