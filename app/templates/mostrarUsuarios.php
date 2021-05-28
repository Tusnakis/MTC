<?php ob_start(); ?>

<h1 class="text-center pt-5">Usuarios</h1>

<!--<div class="row">-->
<div class="bg-white px-3 py-3 rounded">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link <?php echo $añadido = $params['añadido'] !== NULL ? "" : "active" ?>" data-toggle="tab" href="#buscar">Buscar usuario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $añadido = $params['añadido'] !== NULL ? "active" : "" ?>" data-toggle="tab" href="#añadir">Añadir empleado</a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane fade <?php echo $añadido = $params['añadido'] !== NULL ? "" : "show active" ?>" id="buscar">
            <br>
            <form action="index.php?ruta=mostrarUsuariosFiltrados" method="POST">
                <div class="form-group row">
                    <label for="inputUsuario" class=" col-12 col-sm-3 col-form-label mt-3">Usuario</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputRol" class="form-control" id="inputUsuario" name="usuario">
                            <option value="">--</option>
                            <?php for ($i = 0; $i < count($params['resultado2']); $i++) { ?>
                                <option value="<?php echo $params['resultado2'][$i]['usuario'] ?>" <?php echo $usuario = $params['resultado2'][$i]['usuario'] == $params['resultado3'] ? "selected" : "" ?>><?php echo $params['resultado2'][$i]['usuario'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputRol" class="col-12 col-sm-3 col-form-label mt-3">Rol</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <select id="inputRol" class="form-control" name="rol">
                            <option value="">--</option>
                            <option value="user" <?php echo $usuario = $params['resultado4'] == "user" ? "selected" : "" ?>>Usuario</option>
                            <option value="emp" <?php echo $usuario = $params['resultado4'] == "emp" ? "selected" : "" ?>>Empleado</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
            </form>
        </div>
        <div class="tab-pane fade <?php echo $añadido = $params['añadido'] !== NULL ? "show active" : "" ?>" id="añadir">
            <br>
            <form action="index.php?ruta=añadirEmpleado" method="POST">
                <div class="form-group row">
                    <label for="inputUsuario" class=" col-12 col-sm-2 col-form-label mt-3">Usuario</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="inputUsuario" name="usuario" required>
                    </div>
                    <label for="inputContrasena" class=" col-12 col-sm-2 col-form-label mt-3">Contraseña</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="password" class="form-control" id="inputContrasena" name="contrasena" required>
                    </div>
                    <label for="inputNombre" class=" col-12 col-sm-2 col-form-label mt-3">Nombre</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="inputNombre" name="nombre" required>
                    </div>
                    <label for="inputApellidos" class=" col-12 col-sm-2 col-form-label mt-3">Apellidos</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="text" class="form-control" id="inputApellidos" name="apellidos" required>
                    </div>
                    <label for="inputEmail" class=" col-12 col-sm-2 col-form-label mt-3">Email</label>
                    <div class="col-12 col-sm-4 mt-3">
                        <input type="email" class="form-control" id="inputEmail" name="email" required>
                    </div>
                    <input type="hidden" name="rol" value="emp">
                    <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                    <?php if (isset($params['resultado5'])) { ?>
                        <input type="hidden" name="usuarioP" value="<?php echo $params['resultado5'][0] ?>">
                    <?php } ?>
                    <?php if (isset($params['resultado5'])) { ?>
                        <input type="hidden" name="rolP" value="<?php echo $params['resultado5'][1] ?>">
                    <?php } ?>
                </div>
                <?php if ($params['añadido'] !== NULL) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $params['añadido'] ?>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-secondary mt-3">Añadir empleado</button>
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
                    <th class="text-center">Contraseña</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Rol</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < count($params['resultado']); $i++) { ?>
                    <tr>
                        <form action="index.php?ruta=actualizarUsuarios" method="POST">
                            <td><input type="text" name="nuevoUsuario" class="form-control text-center" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['usuario'] ?>" disabled required></td>
                            <input type="hidden" name="usuario" value="<?php echo $params['resultado'][$i]['usuario'] ?>">
                            <td><input type="password" name="contrasena" class="form-control text-center" style="width: 8rem;" value="<?php //echo $params['resultado'][$i]['contrasena'] 
                                                                                                                                        ?>" placeholder="********"></td>
                            <td><input type="text" name="nombre" class="form-control text-center" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['nombre'] ?>" required></td>
                            <td><input type="text" name="apellidos" class="form-control text-center" style="width: 10rem;" value="<?php echo $params['resultado'][$i]['apellidos'] ?>" required></td>
                            <td><input type="text" name="email" class="form-control text-center" style="width: 10rem;" value="<?php echo $params['resultado'][$i]['email'] ?>" required></td>
                            <td><input type="text" name="rol" class="form-control text-center mx-3" style="width: 6rem;" value="<?php echo $params['resultado'][$i]['rol'] ?>" required></td>
                            <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                            <?php if (isset($params['resultado5'])) { ?>
                                <input type="hidden" name="usuarioP" value="<?php echo $params['resultado5'][0] ?>">
                            <?php } ?>
                            <?php if (isset($params['resultado5'])) { ?>
                                <input type="hidden" name="rolP" value="<?php echo $params['resultado5'][1] ?>">
                            <?php } ?>
                            <td class="justify-content-center align-middle">
                                <input title="Actualizar" type="image" src="images/actualizar.png" id="actualizar" alt="actualizar" width="20" height="20" />
                        </form>
                        </td>
                        <td class="justify-content-center align-middle">
                            <form action="index.php?ruta=eliminarUsuarios" method="POST">
                                <input type="hidden" name="usuario" value="<?php echo $params['resultado'][$i]['usuario'] ?>">
                                <input type="hidden" name="pagina" value="<?php echo $params['paginaActual'] ?>">
                                <?php if (isset($params['resultado5'])) { ?>
                                    <input type="hidden" name="usuarioP" value="<?php echo $params['resultado5'][0] ?>">
                                <?php } ?>
                                <?php if (isset($params['resultado5'])) { ?>
                                    <input type="hidden" name="rolP" value="<?php echo $params['resultado5'][1] ?>">
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
<?php if ($params['paginas'] > 1) { ?>
    <div class="row mb-5">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm">
                    <?php if ($params['paginaActual'] == 1) { ?>
                        <li class="page-item disabled">
                            <?php if (isset($params['resultado5'])) { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuariosFiltrados&pagina=<?php echo $params['paginaActual'] - 1 ?>&usuario=<?php echo $params['resultado5'][0] ?>&rol=<?php echo $params['resultado5'][1] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuarios&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <?php if (isset($params['resultado5'])) { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuariosFiltrados&pagina=<?php echo $params['paginaActual'] - 1 ?>&usuario=<?php echo $params['resultado5'][0] ?>&rol=<?php echo $params['resultado5'][1] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuarios&pagina=<?php echo $params['paginaActual'] - 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php } ?>
                    <?php for ($i = 0; $i < $params['paginas']; $i++) { ?>
                        <?php if ($params['paginaActual'] == $i + 1) { ?>
                            <?php if (isset($params['resultado5'])) { ?>
                                <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarUsuariosFiltrados&pagina=<?php echo $i + 1 ?>&usuario=<?php echo $params['resultado5'][0] ?>&rol=<?php echo $params['resultado5'][1] ?>"><?php echo $i + 1 ?></a></li>
                            <?php } else { ?>
                                <li class="page-item active"><a class="page-link" href="index.php?ruta=mostrarUsuarios&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                            <?php } ?>
                        <?php } else { ?>
                            <?php if (isset($params['resultado5'])) { ?>
                                <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarUsuariosFiltrados&pagina=<?php echo $i + 1 ?>&usuario=<?php echo $params['resultado5'][0] ?>&rol=<?php echo $params['resultado5'][1] ?>"><?php echo $i + 1 ?></a></li>
                            <?php } else { ?>
                                <li class="page-item"><a class="page-link" href="index.php?ruta=mostrarUsuarios&pagina=<?php echo $i + 1 ?>"><?php echo $i + 1 ?></a></li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($params['paginas'] == $params['paginaActual']) { ?>
                        <li class="page-item disabled">
                            <?php if (isset($params['resultado5'])) { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuariosFiltrados&pagina=<?php echo $params['paginaActual'] + 1 ?>&usuario=<?php echo $params['resultado5'][0] ?>&rol=<?php echo $params['resultado5'][1] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuarios&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <?php if (isset($params['resultado5'])) { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuariosFiltrados&pagina=<?php echo $params['paginaActual'] + 1 ?>&usuario=<?php echo $params['resultado5'][0] ?>&rol=<?php echo $params['resultado5'][1] ?>" aria-label="Previous">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            <?php } else { ?>
                                <a class="page-link" href="index.php?ruta=mostrarUsuarios&pagina=<?php echo $params['paginaActual'] + 1 ?>" aria-label="Previous">
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

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>