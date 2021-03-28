<?php 

ob_start();

?>

<h3 class="inicio">Bienvenido al Marc Tennis Club</h3>
<time><strong>Fecha:</strong> <?php echo date('d-m-y') ?><br><strong>Hora: </strong> <span id="reloj"></span></time> 

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>