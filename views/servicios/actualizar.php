<h1 class="title">Servicios</h1>
<p class="descripcion">Administracion de servicios</p>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<div class="formulario-container">
    <form action="/servicios/actualizar" method="POST" class="formulario">
        <?php include_once __DIR__ . '/formulario.php'; ?>
        <div class="botones-acciones">
            <input type="submit" class="boton boton-guardar" value="Actualizar">
        </div>
    </form>
</div>