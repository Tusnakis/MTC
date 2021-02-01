<?php ob_start(); ?>
<div class="row justify-content-center">
    <div class="col-12 col-lg-4 my-5">
        <div id="login1" class="card mx-auto" style="width: 20rem; height: 21rem;">
            <div class="card-body">
                <br>
                <h5 class="card-title text-center"><strong>Bienvenido/a<br>al<br>Marc Tennis Club</strong></h5>
                <br>
                <p class="card-text text-center">
                    En nuestro club podrás encontrar las mejores pistas de tenis y padel
                    para practicar tu deporte favorito.
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 my-1">
        <div class="card mx-auto" style="width: 20rem; height: 26rem;">
            <div class="card-body">
                <h5 class="card-title text-center"><strong>Registrate en Marc Tennis Club</strong></h5>
                <br>
                <form action="index.php?ruta=registro" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Usuario</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 my-5">
        <div id="login2" class="card mx-auto" style="width: 20rem; height: 21rem;">
            <div class="card-body">
                <br>
                <h5 class="card-title text-center"><strong>Encuentra<br>la mejor partida<br>en un click</strong></h5>
                <br>
                <p class="card-text text-center">
                    En nuestra web tendrás acceso a todas nuestras pistas diariamente para poder reservarla
                    y jugar la mejor partida posible.
                </p>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>