<?php ob_start(); ?>

<h1 class="text-center">Reserva pista</h1>
<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#buscar">Buscar reserva</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade show active" id="buscar">
            <br>
            <form action="index.php?ruta=listarReservasFiltradas" method="POST">
                <div class="form-group row">
                    <label for="inputTipoPista" class="col-12 col-sm-2 col-form-label mt-3">Tipo de pista</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputTipoPista" class="form-control" name="tipoPista">
                            <?php for ($i = 0; $i < count($params['resultado2']); $i++) { ?>
                                <?php if($params['resultado2'][$i]['nombre'] == $params['resultado4'][2]) { ?>
                                <option value="<?php echo $params['resultado2'][$i]['nombre'] ?>" selected><?php echo ucwords($params['resultado2'][$i]['nombre']) ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $params['resultado2'][$i]['nombre'] ?>"><?php echo ucwords($params['resultado2'][$i]['nombre']) ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <label for="inputNumPista" class="col-12 col-sm-2 col-form-label mt-3">Num. de pista</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputNumPista" class="form-control" name="numPista">
                            <?php for ($i = 0; $i < count($params['resultado5']); $i++) { ?>
                                <?php if ($params['resultado5'][$i]['num_pista'] == $params['resultado4'][1]) { ?>
                                    <option value="<?php echo $params['resultado5'][$i]['num_pista'] ?>" selected><?php echo $params['resultado5'][$i]['num_pista'] ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $params['resultado5'][$i]['num_pista'] ?>"><?php echo $params['resultado5'][$i]['num_pista'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fechaReserva" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="date" class="form-control" id="fechaReserva" name="fecha" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d", strtotime('+ 1 week')) ?>" value="<?php if (!empty($params['resultado4'])) {
                                                                                                                                                                                                        echo $params['resultado4'][0];
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo date("Y-m-d");
                                                                                                                                                                                                    } ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
            </form>
        </div>
    </div>
</div>
<hr>
<div class="row mb-5">
    <div class="col-12 d-flex justify-content-center my-4">
        <table class="table bg-light">
            <thead class="thead bg-secondary text-white">
                <tr>
                    <th class="text-center">Tipo de pista</th>
                    <th class="text-center">N. pista</th>
                    <th class="text-center">Hora inicio</th>
                    <th class="text-center">Hora fin</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Disponibilidad</th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['nombre'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['num_pista'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_inicio'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_fin'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['precio'] ?> €</td>
                        <td class="text-center">
                            <form action="index.php?ruta=reservarPista" method="POST">
                                <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario'] ?>">
                                <input type="hidden" name="tipoPista" value="<?php echo $params['resultado'][$i]['nombre'] ?>">
                                <input type="hidden" name="numPista" value="<?php echo $params['resultado'][$i]['num_pista'] ?>">
                                <input type="hidden" name="pista" value="<?php echo $params['resultado'][$i]['pista'] ?>">
                                <input type="hidden" name="tarifa" value="<?php echo $params['resultado'][$i]['tarifa'] ?>">
                                <input type="hidden" name="fecha" value="<?php if (!empty($params['resultado4'])) {
                                                                                echo $params['resultado4'][0];
                                                                            } else {
                                                                                echo date("Y-m-d");
                                                                            } ?>">
                                <?php $salida = 0 ?>
                                <?php for ($x = 0; $x < count($params['resultado3']); $x++) { ?>
                                    <?php if ($params['resultado'][$i]['nombre'] == $params['resultado3'][$x]['nombre'] && $params['resultado'][$i]['num_pista'] == $params['resultado3'][$x]['num_pista'] && $params['resultado'][$i]['tarifa'] == $params['resultado3'][$x]['id_tarifa']) { ?>
                                        Pista reservada
                                        <?php $salida++; ?>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($salida == 0) { ?>
                                    <input type="submit" class="btn btn-info" value="Reservar">
                                <?php } ?>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>