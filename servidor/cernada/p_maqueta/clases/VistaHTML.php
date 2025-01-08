<?php

class VistaHTML
{
    public function __construct() {}


    public function mostrarExplotacionFlota(
        $disponibles,
        $noDisponibles,
        $entregasEnProceso,
        $tiempoMaximo,
        $tiempoReal,
        $aTiempo,
        $vehiculos,
        $localidad,
        $nombreYKms
    ) {

        echo '<h1>Indicadores de Explotacion de la Flota</h1>';
        echo '<h3>Disponibilidad de Flota:</h3>';
        echo "Vehiculos Disponibles: $disponibles, Vehiculos no disponibles: $noDisponibles <br>";
        echo '<h3>Estado de las entregas:</h3>';
        echo "Entregas en proceso: $entregasEnProceso<br>";
        echo "Promedio tiempo Real: $tiempoReal, Promedio tiempo máximo: $tiempoMaximo<br>";
        echo "Tiempo de llegada en promedio es $aTiempo al previsto<br>";
        echo "<h3> Datos de rendimiento y coste</h3>";
        foreach ($vehiculos as $vehiculo) {
            $kmsParaRevision = 1000 - $vehiculo['kilometros'];
            echo "vehiculo " . $vehiculo['matricula'] . ",recorridos: " . $vehiculo['kilometros'] . ", quedan para mantenimiento $kmsParaRevision <br>";
        }
        echo "Localidad con mas entregas: $localidad<br>";
        echo "Coste de cada conductor:<br>";
        echo '<table border="1" cellpadding="1px">';
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Coste(euros)</th>';
        echo '</tr>';
        foreach ($nombreYKms as $nombreYKm) {
            $totalCoste = $nombreYKm['total'] * 2;
            echo '<tr>';
            echo "<th>{$nombreYKm['nombre']}</th>";
            echo "<th>{$totalCoste}</th>";
            echo '</tr>';
        }
        echo '</table>';
    }

    public function mostrarPosicion($posicion)
    {
        echo '<table border="1" cellpadding="10px">';
        for ($i = 0; $i < 10; $i++) {
            echo '<tr>';
            echo '</tr>';
            for ($j = 0; $j < 10; $j++) {
                if ($i == $posicion[0]['coordenada_x'] && $j == $posicion[0]['coordenada_y']) {
                    echo '<td>';
                    echo "<a href='verDatos.php?matricula={$posicion[0]['matricula']}'>{$posicion[0]['matricula']}</a>";
                    echo '<td>';
                } else if ($i == $posicion[1]['coordenada_x'] && $j == $posicion[1]['coordenada_y']) {
                    echo '<td>';
                    echo "<a href='verDatos.php?matricula={$posicion[1]['matricula']}'>{$posicion[1]['matricula']}</a>";
                    echo '<td>';
                } else {
                    echo '<td></td>';
                }
            }
        }
        echo '</table>';
    }

    public function mostrarRevision( $vehiculos) {
        
        foreach ($vehiculos as $vehiculo) {
            echo "Pasar la revision vehículo: $vehiculo";
        }
    }

    public function mostrarEntregasPendientes($datos){
        echo '<table border="1" cellpadding="10px">';

        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Matricula</th>';
        echo '<th>Conductor</th>';
        echo '<th>Localidad</th>';
        echo '<th>Kilometros</th>';
        echo '<th> Tiempo Maximo</th>';
        echo '</tr>';
        foreach ($datos as $dato) {
            echo '<tr>';
            echo '<td>'. $dato['id'].'</td>';
            echo '<td>'. $dato['matricula'].'</td>';
            echo '<td>'. $dato['nombre'].'</td>';
            echo '<td>'. $dato['localidad'].'</td>';
            echo '<td>'. $dato['kilometros'].'</td>';
            echo '<td>'. $dato['tiempo_maximo'].'</td>';
            echo '</tr>';
        }

        echo '</table>';

    }

    public function verDatosPorMatricula($matricula){
        echo "<h1>DATOS DEL VEHICULO {$matricula[0]['matricula']}</h1>";
        echo "<ul>";
        echo "<li>";
        echo "Tipo: {$matricula[0]['tipo']}";
        echo "</li>";
        echo "<li>";
        echo "Alarma revision: {$matricula[0]['alarma_revision']}";
        echo "</li>";
        echo "<li>";
        echo "Coordenada x: {$matricula[0]['coordenada_x']}";
        echo "</li>";
        echo "<li>";
        echo "Coordenada y: {$matricula[0]['coordenada_y']}";
        echo "</li>";
        echo "</ul>";

    }
}
