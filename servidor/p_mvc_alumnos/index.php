<?php
require_once "controllers/AvistamientosController.php";
require_once "views/MeteoritoBusquedaView.php";

// Instanciar controlador y vista
$controller = new AvistamientosController();
$vistaMeteorito= new MeteoritoBusquedaView();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

   
    // 1 El controlador frontal por cada acción requerida por la interfaz reencamina la solictud al controlador 
    switch ($action) {
        case 'buscar': //Completar
            $nombre=$_GET['nombre'];//1 procesar parametros : nombre
            $controller->buscar($nombre);// 2 reenviar solicitud a controlador
            break;
        case 'calcular': //Completar
            $tamano=$_GET['tam'];//1 procesar parametros :tamaño y velocidad
            $velocidad=$_GET['velocidad'];//1 procesar parametros :tamaño y velocidad
            $controller->obtenerImpacto($tamano,$velocidad);// 2 reenviar solicitud a controlador
            break;
        case 'nueva accion':
            //procesar parametros
            // reenviar solicitud a controlador
    }
} else {
    // Acción por defecto
    $vistaMeteorito->render(null);
}

