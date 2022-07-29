<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php 
include_once __DIR__ . "/../templates/alertas.php";
?>

<?php if($error) return; ?>
<form class="formulario" method="POST" >
    <div class="campo">
        <label for="password_nuevo">Password Nuevo:</label>
        <input 
            type="password"
            id="password_nuevo"
            name="password_nuevo"
            placeholder="Tu Nuevo Password"
       />
    </div>
    <div class="campo">
        <label for="password_nuevo2">Repetir Password Nuevo:</label>
        <input 
            type="password"
            id="password_nuevo2"
            name="password_nuevo2"
            placeholder="Repite Tu Nuevo Password"
       />
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
</div>