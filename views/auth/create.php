<h1 class="title">Crear Cuenta</h1>
<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>
<div class="formulario-container">
    <form action="/createaccount" method="POST" class="formulario">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tú nombre" name="nombre" value="<?php echo $usuario->nombre; ?>">
        </div>
        <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" placeholder="Tú apellido" name="apellido" value="<?php echo $usuario->apellido; ?>">
        </div>
        <div class="campo">
            <label for="telefono">Telefono:</label>
            <input type="tel" id="telefono" placeholder="Tú telefono" name="telefono" value="<?php echo $usuario->telefono; ?>">
        </div>
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Tú email" name="email" value="<?php echo $usuario->email; ?>">
        </div>
        <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" placeholder="Contraseña" name="password">
        </div>
        <div class="botones">
            <input type="submit" class="boton" value="Crear Cuenta">
        </div>
    </form>
    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    </div>
</div>