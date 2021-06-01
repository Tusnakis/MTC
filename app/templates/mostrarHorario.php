<?php ob_start(); ?>

<h1 class="text-center pt-5">Horarios</h1>

<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $enviado = $params['enviado'] !== NULL || isset($texto) ? "" : "active"?>" data-toggle="tab" href="#buscar">Buscar horario</a>
        </li>
        <?php if ($_SESSION['rol'] == 'emp') { ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $enviado = $params['enviado'] !== NULL || isset($texto) ? "active" : ""?>" data-toggle="tab" href="#solicitar">Solicitar vacaciones</a>
            </li>
        <?php } ?>
        <?php if ($_SESSION['rol'] == 'admin') { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#añadir">Añadir puesto</a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade <?php echo $enviado = $params['enviado'] !== NULL || isset($texto) ? "" : "show active"?>" id="buscar">
            <br>
            <form action="index.php?ruta=listarHorarioFiltrado" method="POST" class="buscar">
                <div class="form-group row">
                    <label for="mesHorario" class="col-12 col-sm-2 col-form-label mt-3">Mes</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="mes" name="mes">
                            <?php for ($i = 1; $i <= count($params['meses']); $i++) { ?>
                                <?php if ($params['meses'][$i][0] == $params['resultado4']) { ?>
                                    <option value="<?php echo $params['meses'][$i][0] ?>" selected><?php echo $params['meses'][$i][1] ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $params['meses'][$i][0] ?>"><?php echo $params['meses'][$i][1] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php if ($_SESSION['rol'] == 'admin') { ?>
                    <div class="form-group row">
                        <label for="usuario" class="col-12 col-sm-2 col-form-label mt-3">Empleado</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="usuario" name="usuario">
                                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                                    <?php if ($params['resultado'][$i]['usuario'] == $params['resultado5']) { ?>
                                        <option value="<?php echo $params['resultado'][$i]['usuario'] ?>" selected><?php echo ucwords($params['resultado'][$i]['usuario']) ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $params['resultado'][$i]['usuario'] ?>"><?php echo ucwords($params['resultado'][$i]['usuario']) ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
            </form>
        </div>
        <div class="tab-pane fade" id="añadir">
            <br>
            <form action="index.php?ruta=añadirHorario" method="POST">
                <div class="form-group row">
                    <label for="puesto" class="col-12 col-sm-2 col-form-label mt-3">Puesto</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="puesto" name="puesto" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Añadir</button>
            </form>
        </div>
        <div class="tab-pane fade <?php echo $enviado = $params['enviado'] !== NULL || isset($texto) ? "show active" : ""?>" id="solicitar">
            <br>
            <form action="index.php?ruta=solicitarVacaciones" method="POST">
                <div class="form-group row">
                    <label for="fechaInicio" class="col-12 col-sm-2 col-form-label mt-3">Fecha inicio</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" min="<?php echo date("Y-m-d", strtotime('+ 15 day')) ?>" max="2021-12-31" required>
                    </div>
                    <label for="fechaFin" class="col-12 col-sm-2 col-form-label mt-3">Fecha fin</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="date" class="form-control" id="fechaFin" name="fechaFin" min="<?php echo date("Y-m-d", strtotime('+ 15 day')) ?>" max="2021-12-31" required>
                    </div>
                </div>
                <p style="font-size: 10px;">*Las vacaciones se tienen que pedir con 15 días de antelación</p>
                <?php if ($params['enviado'] !== NULL) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $params['enviado'] ?>
                    </div>
                <?php } elseif(isset($texto)) { ?>
                    <div class="alert alert-success" role="alert">
                        La solicitud ha sido enviada con éxito. El administrador le contestará lo más pronto posible.
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-secondary mt-3" name="enviado">Solicitar</button>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="row mb-5">
    <div class="col-12 col-sm-10 col-lg-10 d-flex justify-content-center my-4">
        <table class="table table-bordered bg-light">
            <thead class="thead">
                <tr>
                    <th colspan="7" class="text-center bg-dark text-white"> <?php echo $params['resultado6'] ?> <?php echo $params['resultado2']['año'] ?> </th>
                </tr>
                <tr>
                    <th colspan="7" class="text-center bg-info text-white"> <?php echo ucwords($params['resultado5']) ?></th>
                </tr>
                <tr>
                    <?php foreach ($params['resultado2']['diasSemana'] as $diaSemana) { ?>
                        <td class="text-center bg-secondary text-white"><?php echo $diaSemana ?></td>
                    <?php } ?>
                </tr>
            </thead>
            <tr>
                <?php for ($i = 0; $i < $params['resultado2']['vacio']; $i++) { ?>
                    <td></td>
                <?php } ?>
                <?php for ($i = 1; $i <= $params['resultado2']['diasMes']; $i++) { ?>
                    <?php if ($i < 10) { ?>
                        <?php if (in_array("2021" . "-" . $params['resultado7'] . "-" . "0" . $i, $params['resultado8'])) { ?>
                            <?php if ("2021" . "-" . $params['resultado7'] . "-" . "0" . $i == date('Y-m-d')) { ?>
                                <?php for ($x = 0; $x < count($params['asignacionesUsuario']); $x++) { ?>
                                    <?php if ("2021" . "-" . $params['resultado7'] . "-" . "0" . $i == $params['asignacionesUsuario'][$x]['fecha']) { ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tienda") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Bar") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Mantenimiento") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Padel") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tenis") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white dias font-weight-bold turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white dias font-weight-bold turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white dias font-weight-bold turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white dias font-weight-bold turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Vacaciones") { ?>
                                            <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                <td class="text-center vacaciones text-white dias font-weight-bold" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                            <?php } else { ?>
                                                <td class="text-center vacaciones text-white dias font-weight-bold"><?php echo $i ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php for ($x = 0; $x < count($params['asignacionesUsuario']); $x++) { ?>
                                    <?php if ("2021" . "-" . $params['resultado7'] . "-" . "0" . $i == $params['asignacionesUsuario'][$x]['fecha']) { ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tienda") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Bar") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Mantenimiento") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Padel") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tenis") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Vacaciones") { ?>
                                            <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                <td class="text-center vacaciones text-white dias" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                            <?php } else { ?>
                                                <td class="text-center vacaciones text-white dias"><?php echo $i ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ("2021" . "-" . $params['resultado7'] . "-" . "0" . $i == date('Y-m-d')) { ?>
                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                    <td class="text-center font-weight-bold dias" data-toggle="modal" data-target="#asignarModal"><?php echo $i ?></td>
                                <?php } else { ?>
                                    <td class="text-center font-weight-bold dias"><?php echo $i ?></td>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                    <td class="text-center dias" data-toggle="modal" data-target="#asignarModal"><?php echo $i ?></td>
                                <?php } else { ?>
                                    <td class="text-center dias"><?php echo $i ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <?php if (in_array("2021" . "-" . $params['resultado7'] . "-" . $i, $params['resultado8'])) { ?>
                            <?php if ("2021" . "-" . $params['resultado7'] . "-" . $i == date('Y-m-d')) { ?>
                                <?php for ($x = 0; $x < count($params['asignacionesUsuario']); $x++) { ?>
                                    <?php if ("2021" . "-" . $params['resultado7'] . "-" . $i == $params['asignacionesUsuario'][$x]['fecha']) { ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tienda") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Bar") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Mantenimiento") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Padel") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tenis") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white font-weight-bold dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white font-weight-bold dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white font-weight-bold dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white font-weight-bold dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Vacaciones") { ?>
                                            <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                <td class="text-center vacaciones text-white font-weight-bold dias" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                            <?php } else { ?>
                                                <td class="text-center vacaciones text-white font-weight-bold dias"><?php echo $i ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php for ($x = 0; $x < count($params['asignacionesUsuario']); $x++) { ?>
                                    <?php if ("2021" . "-" . $params['resultado7'] . "-" . $i == $params['asignacionesUsuario'][$x]['fecha']) { ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tienda") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-warning text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-warning text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Bar") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-primary text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-primary text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Mantenimiento") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-danger text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-danger text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Padel") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center bg-success text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center bg-success text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Tenis") { ?>
                                            <?php if ($params['asignacionesUsuario'][$x]['turno'] == 1) { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white dias turno1" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white dias turno1"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                    <td class="text-center tenis text-white dias turno2" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                                <?php } else { ?>
                                                    <td class="text-center tenis text-white dias turno2"><?php echo $i ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if ($params['asignacionesUsuario'][$x]['puesto'] == "Vacaciones") { ?>
                                            <?php if ($_SESSION['rol'] == 'admin') { ?>
                                                <td class="text-center vacaciones text-white dias" data-toggle="modal" data-target="#actualizarModal"><?php echo $i ?></td>
                                            <?php } else { ?>
                                                <td class="text-center vacaciones text-white dias"><?php echo $i ?></td>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if ("2021" . "-" . $params['resultado7'] . "-" . $i == date('Y-m-d')) { ?>
                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                    <td class="text-center font-weight-bold dias" data-toggle="modal" data-target="#asignarModal"><?php echo $i ?></td>
                                <?php } else { ?>
                                    <td class="text-center font-weight-bold dias"><?php echo $i ?></td>
                                <?php } ?>
                            <?php } else { ?>
                                <?php if ($_SESSION['rol'] == 'admin') { ?>
                                    <td class="text-center dias" data-toggle="modal" data-target="#asignarModal"><?php echo $i ?></td>
                                <?php } else { ?>
                                    <td class="text-center dias"><?php echo $i ?></td>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if (($i + $params['resultado2']['vacio']) % 7 == 0) { ?>
            </tr>
            <tr>
            <?php } ?>
        <?php } ?>
        <?php for ($i = 0; ($i + $params['resultado2']['vacio'] + $params['resultado2']['diasMes']) % 7 != 0; $i++) { ?>
            <td></td>
        <?php } ?>
            </tr>
        </table>
    </div>
    <div class="col-12 col-sm-2 my-sm-5">
        <table class="table table-bordered">
            <tr>
                <td class="mx-2 bg-primary text-white leyenda">Bar</td>
            </tr>
            <td class="mx-2 bg-warning text-white leyenda">Tienda</td>
            <tr>
                <td class="mx-2 bg-danger text-white leyenda">Mantenimiento</td>
            </tr>
            <tr>
                <td class="mx-2 bg-success text-white leyenda">Padel</td>
            </tr>
            <tr>
                <td class="mx-2 tenis text-white leyenda">Tenis</td>
            </tr>
            <tr>
                <td class="mx-2 vacaciones text-white leyenda">Vacaciones</td>
            </tr>
            <tr>
                <td class="mx-2 turno1 bg-light leyenda">Mañanas</td>
            </tr>
            <tr>
                <td class="mx-2 turno2 bg-light leyenda">Tardes</td>
            </tr>
        </table>
    </div>
</div>
<div class="modal fade" id="asignarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php?ruta=asignarHorario" method="POST" class="asignar">
                    <div class="form-group row">
                        <label for="usuario" class="col-12 col-sm-2 col-form-label mt-3">Empleado</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <input type="text" class="form-control" name="usuario" value="<?php echo $params['resultado5'] ?>" readonly>
                        </div>
                        <label for="fecha" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <input type="text" class="form-control fecha" id="fecha" name="fecha" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario" class="col-12 col-sm-2 col-form-label mt-3">Puesto</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="horario" name="horario">
                                <?php for ($i = 0; $i < count($params['resultado3']); $i++) { ?>
                                    <?php if ($_SESSION['rol'] == 'admin') { ?>
                                        <option value="<?php echo $params['resultado3'][$i]['id'] ?>"><?php echo $params['resultado3'][$i]['puesto'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $params['resultado3'][$i]['id'] ?>"><?php echo $params['resultado3'][$i]['puesto'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="turno" class="col-12 col-sm-2 col-form-label mt-3">Turno</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="turno" name="turno">
                                <option value="1">Mañana</option>
                                <option value="2">Tarde</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="mes" value="<?php echo $params['resultado4'] ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary mt-3">Asignar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="actualizarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php?ruta=actualizarHorario" method="POST" class="asignar">
                    <div class="form-group row">
                        <label for="usuario" class="col-12 col-sm-2 col-form-label mt-3">Empleado</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <input type="text" class="form-control" name="usuario" value="<?php echo $params['resultado5'] ?>" readonly>
                        </div>
                        <label for="fecha" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <input type="text" class="form-control fecha" id="fecha" name="fecha" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horario" class="col-12 col-sm-2 col-form-label mt-3">Puesto</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="horarioActualizar" name="horario">
                                <?php for ($i = 0; $i < count($params['resultado3']); $i++) { ?>
                                    <option value="<?php echo $params['resultado3'][$i]['id'] ?>"><?php echo $params['resultado3'][$i]['puesto'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="turno" class="col-12 col-sm-2 col-form-label mt-3">Turno</label>
                        <div class="col-12 col-sm-4 mt-3">
                            <select id="turnoActualizar" name="turno">
                                <option value="1">Mañana</option>
                                <option value="2">Tarde</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="mes" value="<?php echo $params['resultado4'] ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary mt-3">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>