<?php ob_start(); ?>

<h1 class="text-center">Perfil</h1>
<div class="row mb-5">
    <div class="col-12 col-lg-6 my-3 d-flex justify-content-center">
        <form enctype="multipart/form-data" action="index.php?ruta=perfil" method="POST">
            <div class="form-group row">
                <label for="exampleInputUser" class="col-sm-3 col-form-label">Usuario</label>
                <div class="col-sm-9">
                    <input type="text" name="usuario" class="form-control" value="<?php echo $params['resultado'][0]['usuario'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Contraseña</label>
                <div class="col-sm-9">
                    <input type="password" name="contrasena" class="form-control" value="<?php echo $params['resultado'][0]['contrasena'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputName" class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-9">
                    <input type="text" name="nombre" class="form-control" value="<?php echo $params['resultado'][0]['nombre'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputSurname" class="col-sm-3 col-form-label">Apellidos</label>
                <div class="col-sm-9">
                    <input type="text" name="apellidos" class="form-control" value="<?php echo $params['resultado'][0]['apellidos'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleInputEmail" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" value="<?php echo $params['resultado'][0]['email'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="imagen" required>
                    <label class="custom-file-label">Elegir imagen</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <div class="col-12 col-lg-6 my-3 d-flex justify-content-center">
        <img src="<?php if (/*isset($_SESSION['foto']) && */file_exists($params['resultado'][0]['foto'])) {
                        echo $params['resultado'][0]['foto'];
                    } else {
                        echo 'images/perfil.jpg';
                    } ?>" alt="perfil" width="300" height="300" />
    </div>
</div>
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>