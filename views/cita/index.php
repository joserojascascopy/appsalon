<h1 class="title">Crear Nueva Cita</h1>
<p class="descripcion">Elige tus servicios y completa con tus datos</p>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<div id="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button> <!-- "data-paso" es un atributo personalizado -->
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>
    <div id="paso-1" class="seccion mostrar">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    <div id="paso-2" class="seccion">
        <h2>Tus datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tú nombre" value="<?php echo $nombre; ?>" disabled>
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" min="<?php echo $date; ?>">
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora">
            </div>
            <div class="alertas"></div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>
    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
        <div class="contenido-resumen"></div>
        <div class="alerta-resumen"></div>
    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button> <!-- &laquo; entidad (flecha a la izquierda) -->
        <button id="siguiente" class="boton">Siguiente &raquo;</button> <!-- &raquo; entidad (flecha a la derecha) -->
    </div>
</div>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/script.js'></script>
    ";
?>