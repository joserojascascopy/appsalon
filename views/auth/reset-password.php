<h1 class="title">Recuperar contraseña</h1>
<?php include_once __DIR__ . '/../templates/alertas.php'; 
if($error) {
    return;
}
?>
<p class="descripcion">Introduzca su nueva contraseña</p>
<div class="formulario-container">
    <form method="POST" class="formulario"> <!-- Si es POST, no hace falta el action porque o sino elimina el query string -->
    <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Tú contraseña">
        </div>
        <div class="botones">
            <input type="submit" class="boton boton-recuperar" value="Reestablecer Contraseña">
        </div>
    </form>
    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    </div>
</div>