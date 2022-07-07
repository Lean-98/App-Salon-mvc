<?php  if(isset($_SESSION['admin'])) { ?>
<div class="barra">
    <p>Hola: <?php echo $nombre ?? ''; ?></p>
    <a class="boton" href="/admin">Volver</a>
</div>
<?php } ?>