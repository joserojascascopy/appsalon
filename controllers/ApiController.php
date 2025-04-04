<?php

namespace Controllers;

use Model\Servicios;
use Model\Cita;
use Model\CitaServicio;

class ApiController {
    public static function index() {
        $servicios = Servicios::all();

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

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            // Traemos la cita desde la BD con el id a eliminar
            $cita = Cita::find($id);
            // Eliminamos la cita
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}