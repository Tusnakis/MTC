<?php ob_start(); ?>

<h1>Usuarios</h1>

<div class="row">
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
                            <td><input type="text" name="nuevoUsuario" class="form-control text-center" value="<?php echo $params['resultado'][$i]['usuario'] ?>" required></td>
                            <input type="hidden" name="usuario" value="<?php echo $params['resultado'][$i]['usuario'] ?>" required>
                            <td><input type="text" name="contrasena" class="form-control text-center" value="<?php echo $params['resultado'][$i]['contrasena'] ?>" required></td>
                            <td><input type="text" name="nombre" class="form-control text-center" value="<?php echo $params['resultado'][$i]['nombre'] ?>" required></td>
                            <td><input type="text" name="apellidos" class="form-control text-center" value="<?php echo $params['resultado'][$i]['apellidos'] ?>" required></td>
                            <td><input type="text" name="email" class="form-control text-center" value="<?php echo $params['resultado'][$i]['email'] ?>" required></td>
                            <td><input type="text" name="rol" class="form-control text-center" value="<?php echo $params['resultado'][$i]['rol'] ?>" required></td>
                            <td class="justify-content-center">
                                <input type="image" src="images/actualizar.png" alt="actualizar" width="20" height="20" />
                        </form>
                        </td>
                        <td>
                            <form action="index.php?ruta=eliminarUsuarios" method="POST">
                                <input type="hidden" name="usuario" value="<?php echo $params['resultado'][$i]['usuario'] ?>">
                                <input type="image" src="images/eliminar.png" alt="eliminar" width="20" height="20" />
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