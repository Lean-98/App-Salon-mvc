<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) return; ?>
<form class="formulario" method="POST" >
    <div class="campo">
        <label for="password_nuevo">Password:</label>
        <input 
            type="password"
            id="password_nuevo"
            name="password_nuevo"
            placeholder="Tu Nuevo Password"
       />
    </div>
    <div class="campo">
        <label for="password_nuevo2">Repetir Password:</label>
        <input 
            type="password"
            id="password_nuevo2"
            name="password_nuevo2"
            placeholder="Repite Tu Nuevo Password"
       />
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password">
</form>

<?php 
include_once __DIR__ . "/../templates/footer.php";
?>