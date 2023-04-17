<?php
require_once '../models/Estudiante.php';

if(isset($_POST['operacion'])){
    
    $estudiante = new Estudiante();

    if($_POST['operacion'] == 'registrar'){
        //PASO 1 : Recolectar todos los valores enviados
        // por la vista y almacenarlos es un array asociativo
        $datosGuardar = [
            "apellidos"         => $_POST['apellidos'],
            "nombres"           => $_POST['nombres'],
            "tipodocumento"     => $_POST['tipodocumento'],
            "nrodocumento"      => $_POST['nrodocumento'],
            "fechanacimiento"   => $_POST['fechanacimiento'],
            "idcarrera"         => $_POST['idcarrera'],
            "idsede"            => $_POST['idsede'],
            "fotografia"        => ''
        ];

        // Vamos a verificar si la vista nos envio una FOTO
        if (isset($_FILES['fotografia'])){

            $rutaDestino = '../views/img/fotografias/';
            $fechaActual = date('c'); //C = complete, Año/Mes/Dia/Hora/Minuto/Segundo
            $nombreArchivo = sha1($fechaActual) . ".jpg";
            $rutaDestino .= $nombreArchivo;


            //Guardamos la fotografia
            if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)){
                $datosGuardar['fotografia']= $nombreArchivo;

            }


        }
        //PASO 2: Enviar el array el metodo registar
        $estudiante->registrarEstudiante($datosGuardar);
    }
}