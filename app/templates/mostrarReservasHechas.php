<?php ob_start(); ?>

<h1 class="text-center pt-5">Reservas</h1>
<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#buscar">Buscar reserva</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade show active" id="buscar">
            <br>
            <form action="index.php?ruta=mostrarReservasHechas" method="POST">
                <div class="form-group row">
                    <label for="fechaReserva" class="col-12 col-sm-2 col-form-label mt-3">Fecha</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="date" class="form-control" id="fechaReserva" name="fecha" min="<?php echo date("Y-m-d") ?>" max="<?php echo date("Y-m-d", strtotime('+ 1 week')) ?>" value="<?php if (!empty($params['resultado4'])) {
                                                                                                                                                                                                        echo $params['resultado4'];
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
<div class="row <?php echo $sinPaginas = $params['paginas'] <= 1 ? "mb-5" : "" ?>">
    <div class="col-12 d-flex justify-content-center my-4">
        <table class="table bg-light">
            <thead class="thead bg-secondary text-white">
                <tr>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Tipo de pista</th>
                    <th class="text-center">N. de pista</th>
                    <th class="text-center">Patrocinador</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Hora inicio</th>
                    <th class="text-center">Hora fin</th>
                    <?php if ($_SESSION['rol'] == 'admin') { ?>
                        <th></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['usuario'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['nombre'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['num_pista'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['patrocinador'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['fecha'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_inicio'] ?></td>
                        <td class="text-center align-middle"><?php echo $params['resultado'][$i]['hora_fin'] ?></td>
                        <?php if ($_SESSION['rol'] == 'admin') { ?>
                            <td class="justify-content-center align-middle" style="width: 3rem;">
                                <form action="index.php?ruta=eliminarReserva" method="POST">
                                    <input type="hidden" name="idReserva" value="<?php echo $params['resultado'][$i]['id'] ?>">
                                    <input type="hidden" name="fecha" value="<?php echo $params['resultado'][$i]['fecha'] ?>">
                                    <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                    <input title="Eliminar" type="image" src="images/eliminar.png" id="eliminar" alt="eliminar" width="20" height="20" />
                                </form>
                            </td>
                        <?php } ?>
                    </tr>
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
                            <a class="page-link" href="index.php?ruta=mostrarReservasHechas&pagina=<?php echo $params['paginaActual'] - 1 ?>&fecha=<?php echo $params['resultado4'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?ruta=mostrarReservasHechas&pagina=<?php echo $params['paginaActual'] - 1 ?>&fecha=<?php echo $params['resultado4'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php for ($i = 0; $i < $params['paginas']; $i++) { ?>
                        <?php if ($params['paginaActual'] == $i + 1) { ?>
                            <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarReservasHechas&pagina=<?php echo $i + 1 ?>&fecha=<?php echo $params['resultado4'] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } else { ?>
                            <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarReservasHechas&pagina=<?php echo $i + 1 ?>&fecha=<?php echo $params['resultado4'] ?>"><?php echo $i + 1 ?></a></li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($params['paginas'] == $params['paginaActual']) { ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="index.php?ruta=mostrarReservasHechas&pagina=<?php echo $params['paginaActual'] + 1 ?>&fecha=<?php echo $params['resultado4'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="index.php?ruta=mostrarReservasHechas&pagina=<?php echo $params['paginaActual'] + 1 ?>&fecha=<?php echo $params['resultado4'] ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
<?php } ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>