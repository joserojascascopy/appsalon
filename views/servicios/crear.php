<h1 class="title">Nuevo Servicio</h1>
<p class="descripcion">Completa todos los campos para añadir un nuevo servicio</p>
<?php 
    include_once __DIR__ . '/../templates/barra.php'; 
    include_once __DIR__ . '/../templates/alertas.php';
?>
<div class="formulario-container">
    <form action="/servicios/crear" method="POST" class="formulario">
        <?php include_once __DIR__ . '/formulario.php'; ?>
        <div class="botones-acciones">
            <input type="submit" class="boton boton-guardar" value="Guardar Servicio">
            <a href="/servicios/actualizar" class="boton">Actualizar Servicios</a>
        </div>
    </form>
</div>