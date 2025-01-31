<h1 class="title">Crear Cuenta</h1>
<div class="formulario-container">
    <form action="/createaccount" method="POST" class="formulario">
        <div class="campo">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Tú nombre" name="nombre">
        </div>
        <div class="campo">
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" placeholder="Tú apellido" name="apellido">
        </div>
        <div class="campo">
            <label for="telefono">Telefono:</label>
            <input type="tel" id="telefono" placeholder="Tú telefono" name="telefono">
        </div>
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Tú email" name="email">
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