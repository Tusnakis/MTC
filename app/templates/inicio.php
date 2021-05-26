<?php

ob_start();

?>
<div class="row justify-content-center pt-5">
    <div class="col-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" style="height: 350px;" src="images/slide1.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" style="height: 350px" src="images/slide2.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" style="height: 350px;" src="images/slide3.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-12 text-right mt-3">
        <time class="inicio"><strong>Fecha:</strong> <?php echo date('d-m-y') ?><br><strong>Hora: </strong> <span id="reloj"></span></time>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border border-secondary mx-auto my-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Reserva pista de tenis</h5>
                <p class="card-text">Echa un vistazo a las pistas de tenis que tenemos disponibles ahora mismo</p>
                <a href="index.php?ruta=listarReservasFiltradas&pagina=1&tipoPista=Tenis&numPista=1&fecha=<?php echo date('Y-m-d') ?>" class="btn btn-primary">Reserva ya</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border border-secondary mx-auto my-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Reserva pista de tenis</h5>
                <p class="card-text">Echa un vistazo a las pistas de padel que tenemos disponibles ahora mismo</p>
                <a href="index.php?ruta=listarReservasFiltradas&pagina=1&tipoPista=Padel&numPista=1&fecha=<?php echo date('Y-m-d') ?>" class="btn btn-primary">Reserva ya</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card border border-secondary mx-auto my-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">Pídenos información</h5>
                <p class="card-text">Escríbenos y te informaremos de nuestras clases disponibles o de lo que quieras saber.</p>
                <a href="index.php?ruta=mostrarMensajes" class="btn btn-primary">Escribenos ya</a>
            </div>
        </div>
    </div>
</div>
<div class="col-12 mt-5">
    <img class="d-block w-100" style="height: 150px;" src="images/banner.jpg" alt="banner">
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>