<h1 class="title">Login</h1>
<p class="descripcion">Inicia sesión con tus datos</p>
<div class="formulario-container">
    <form action="/" class="formulario" method="POST">
        <div class="campo">
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="Tú email" name="email">
        </div>
        <div class="campo">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" placeholder="Tú contraseña">
        </div>
        <div class="botones">
            <input type="submit" class="boton" value="Iniciar Sesión">
            <p class="texto-login">o</p>
            <a href="/createaccount" class="boton boton-registrarse">Registrarse</a>
        </div>
    </form>
    <div class="acciones">
        <a href="/forgotpassword">¿Olvidaste tu contraseña?</a>
    </div>
</div