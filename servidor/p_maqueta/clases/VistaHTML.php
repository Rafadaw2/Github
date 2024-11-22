<?php
class VistaHTML{
    public function mostrarVehivulosDisponiblesNoDis($disponibles,$noDisponibles) {
        echo "<h3>Disponibilidad de Flota</h3>";
        
        echo "<p>Vehiculos disponibles: {$disponibles['num']} - Vehiculos no disponibles: {$noDisponibles['num']}</p>";
        
    
    }
    public function mostrarEstadoEntregas($entregasPendientes, $promedioTempReal, $promedioTempMaximo) {
        echo "<h3>Estado de las entregas</h3>";

        echo "<p>Entregas en proceso : {$entregasPendientes['num']}</p>";
        echo "<p>Promedio real: {$promedioTempReal}, Promedio tiempo máximo: {$promedioTempMaximo}</p>";
        if($promedioTempReal<$promedioTempMaximo){
            echo"<p>TIEMPO DE LLEGADA en proimedio inferior al previsto</p>";
        }else{
            echo"<p>TIEMPO DE LLEGADA en proimedio superior al previsto</p>";
        }
    }
    public function mostrarRendimientoCostes($kmsVehiculos, $localidadMasEntregas,$kmConductores) {
        echo "<h3>Datos de rendimiento y coste</h3>";
        foreach($kmsVehiculos as $kmvehiculo){
            $quedan=1000-$kmvehiculo['kilometros'];
            echo "<p>vehiculo {$kmvehiculo['matricula']}, recorridos: {$kmvehiculo['kilometros']}, quedan para mantenimiento: {$quedan}</p>";
        }
        echo "<p>Localidad con más entregas: {$localidadMasEntregas['localidad']}</p>";
        echo "<p>Coste de cada conductor</p>";
        echo "<table>";
        echo "<tr>
        <th>Nombre</th>
        <th>Coste</th>
        </tr>";
        foreach($kmConductores as $conductor){
            echo "<tr>";
            foreach($conductor as $dato){
                echo"<td>$dato</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    public function mostrarVehiculosRevision($vehiculosRevision) {

        foreach($vehiculosRevision as $vehiculo){
            if($vehiculo['km']>1000){
            echo "<p>Pasar la revisión vehículo : {$vehiculo['matricula']}</p>";
            }
        }
        
    }
}
