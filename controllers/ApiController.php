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
        $cita = new Cita($_POST);

        $resultado = $cita->guardar();

        $id = $resultado['id']; // id de la cita guardada

        $idServicios = explode(",", $_POST['servicios']);

        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];

            $citaServicios = new CitaServicio($args);
            $citaServicios->guardar();
        }

        echo json_encode($resultado);
    }
}