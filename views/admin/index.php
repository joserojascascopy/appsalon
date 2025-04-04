<h1 class="title">Panel de Administrador</h1>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<h3>Buscar Citas</h3>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<div class="busqueda">
    <form class="formulario-container">
        <div class="campo">
            <label for="fecha">Fecha:</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>

<div class="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        foreach($citas as $key => $cita) : 
            if($idCita !== $cita->id) { 
                $total = 0;
            ?>
                <li>
                    <h3>Cita</h3>
                    <p>ID: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>Email: <span><?php echo $cita->email; ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
                </li>
                <h3>Servicios</h3>
                <?php $idCita = $cita->id; ?>
            <?php } ?>
            <p class="servicio"><?php echo $cita->servicio . " " . $cita->precio;?></p>
            <?php
                $total += $cita->precio;
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0;

                if(esUltimo($actual, $proximo)) { ?>
                    <p class="total">Total: <span>$<?php echo $total; ?></span></p>
                <?php }
            ?>
        <?php endforeach; ?>
    </ul>
</div>

<?php 
    $script = "<script src='build/js/buscador.js'></script>";
?>