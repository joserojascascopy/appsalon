<?php

namespace Controllers;

use Model\Servicio;
use Model\Cita;
use Model\CitaServicio;

class ApiController {
    public static function index() {
        $servicios = Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar() {
        // Almacena la cita y devuelve el id
        $cita = new Cita($_POST);

        $resultado = $cita->guardar();

        // Almacena la cita y los servicios asociados a la cita
        $id = $resultado['id']; // id de la cita guardada

        $serviciosId = explode(",", $_POST['servicios']);

        foreach($serviciosId as $servicioId) {
            $args = [
                'citaId' => $id,
                'servicioId' => $servicioId
            ];

            $citaServicios = new CitaServicio($args);
            $citaServicios->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }
}