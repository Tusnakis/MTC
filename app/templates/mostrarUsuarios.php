<?php ob_start(); ?>

<h1 class="text-center mt-2">Usuarios</h1>

<div class="row">
    <div class="col-12 col-sm-4 d-flex my-4 card mx-auto py-3 px-3 bg-light">
        <form action="index.php?ruta=mostrarUsuariosFiltrados" method="POST">
            <h3 class="text-center">Buscar usuario</h3>
            <div class="form-group row">
                <label for="inputUsuario" class=" col-12 col-sm-3 col-form-label mt-3">Usuario</label>
                <div class="col-12 col-sm-8 mt-3">
                    <input type="text" class="form-control" id="inputUsuario" name="usuario">
                </div>
                <label for="inputRol" class="col-12 col-sm-3 col-form-label mt-3">Rol</label>
                <div class="col-12 col-sm-8 mt-3">
                    <select id="inputRol" class="form-control" name="rol">
                        <option value="">--</option>
                        <option value="user">Usuario</option>
                        <option value="emp">Empleado</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Buscar</button>
        </form>
    </div>
    <div class="col-12 col-sm-8 d-flex my-4 card mx-auto py-3 px-3 bg-light">
        <form action="index.php?ruta=añadirEmpleado" method="POST">
            <h3 class="text-center">Añadir empleado</h3>
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
            </div>
            <button type="submit" class="btn btn-secondary mt-3">Añadir empleado</button>
        </form>
    </div>
</div>
<hr>
<div class="row mb-5">
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
                            <td><input type="text" name="nuevoUsuario" class="form-control text-center" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['usuario'] ?>" required></td>
                            <input type="hidden" name="usuario" value="<?php echo $params['resultado'][$i]['usuario'] ?>">
                            <td><input type="password" name="contrasena" class="form-control text-center" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['contrasena'] ?>" required></td>
                            <td><input type="text" name="nombre" class="form-control text-center" style="width: 8rem;" value="<?php echo $params['resultado'][$i]['nombre'] ?>" required></td>
                            <td><input type="text" name="apellidos" class="form-control text-center" style="width: 10rem;" value="<?php echo $params['resultado'][$i]['apellidos'] ?>" required></td>
                            <td><input type="text" name="email" class="form-control text-center" style="width: 10rem;" value="<?php echo $params['resultado'][$i]['email'] ?>" required></td>
                            <td><input type="text" name="rol" class="form-control text-center mx-3" style="width: 6rem;" value="<?php echo $params['resultado'][$i]['rol'] ?>" required></td>
                            <td class="justify-content-center">
                                <input data-toggle="tooltip" title="Actualizar" type="image" src="images/actualizar.png" id="actualizar" alt="actualizar" width="20" height="20" />
                        </form>
                        </td>
                        <td>
                            <form action="index.php?ruta=eliminarUsuarios" method="POST">
                                <input type="hidden" name="usuario" value="<?php echo $params['resultado'][$i]['usuario'] ?>">
                                <input data-toggle="tooltip" title="Eliminar" type="image" src="images/eliminar.png" id="eliminar" alt="eliminar" width="20" height="20" />
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $contenido = ob_get_clean(); ?>

<?php include 'layout.php' ?>