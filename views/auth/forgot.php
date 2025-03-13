<h1 class="title">Recuperar contraseña</h1>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<p class="descripcion">Ingrese su email para recuperar su contraseña</p>
<div class="formulario-container">
    <form action="/forgotpassword" method="POST" class="formulario">
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Tú email" name="email">
        </div>
        <div class="botones">
            <input type="submit" class="boton boton-recuperar" value="Recuperar Contraseña">
        </div>
    </form>
    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    </div>
</div>