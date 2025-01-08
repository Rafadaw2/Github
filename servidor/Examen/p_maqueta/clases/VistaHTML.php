<?php

class VistaHTML{
    public function mostrarDisponibilidad($disponibles, $no_disponibles) {
        echo" <h1>Indicadores de Explotación de la Flota</h1>
        <h3>Disponibilidad de la Flota</h3>
        <p>Vehiculos disponibles: {$disponibles}, No disponibles: {$no_disponibles}</p></br>";
    }
    public function mostrarEstadoLLegadas($entregas_pendientes, $promedio_real, $promedio_maximo) {
        echo" <h3>Estado de las Entregas</h3>
        <p>Entregas en proceso: {$entregas_pendientes['e_pendientes']}.</p>
        <p>Promedio real: {$promedio_real['promedio_t_real']}, Promedio tiempo máximo: {$promedio_maximo['promedio_t_maximo']}</p>
        <p>TIEMPO DE LLEGADA en promedio ";
        if(($promedio_maximo['promedio_t_maximo']-$promedio_real['promedio_t_real'])>0){
            echo 'inferior al previsto</p></br>';
        }else{
            echo 'superior al previsto</p></br>';
        }
    }
    public function mostrarRendimiento($datos_rendimiento, $localidadMasEntregas, $costeConductor) {
        echo" <h3>Datos de rendimiento y coste</h3>
        <p>Datos de mantenimiento:</p>";
        foreach($datos_rendimiento as $fila){
            echo "<p>Vehiculo {$fila['matricula']}, recorridos: {$fila['km']}, queda para mantenimieto: {$fila['km_restantes']}.</p>";
        }
        echo "<p>Localidad con más entregas: {$localidadMasEntregas['localidad']}</p>
        <p>Coste de cada conductor:</p>
        <table border=1>
        <tr>
        <th>Nombre</th>
        <th>Coste(euros)</th>
        </tr>";
        foreach($costeConductor as $conductor){
            echo "<tr>
            <td>{$conductor['nombre']}</td>
            <td>{$conductor['coste']}</td>
            </tr>";
        }
        echo "</table>";
        


    }

    public function mostrarVehiculos($vehiculos){
        echo"<h3>Posición de Vehículos en Ruta</h3>";
        echo "<table border=1>";
        for($i=10;$i>0;$i--){
            echo "<tr>";
            for($j=0;$j<10;$j++){
                echo "<td>";
                $relleno=0;
                foreach($vehiculos as $vehiculo){
                    if($vehiculo['coordenada_y']==$i && $vehiculo['coordenada_x']==$j){
                        echo "<a href='../control/verInfoVehiculo.php?";
                        echo "matricula={$vehiculo['matricula']}";
                        echo "'>{$vehiculo['matricula']}</a>" ;
                        
                        $relleno=1;
                    }
                }
                if($relleno==0){
                    echo "--";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    public function mostrarDetalleVehiculo($vehiculo){
        echo"<h3>Detalles del vehículo {$vehiculo['matricula']}</h3>";
        echo "<table border=1>
        <tr>
        <th>Id</th>
        <th>Tipo</th>
        <th>Matricula</th>
        <th>Alarma</th>
        <th>Coordenada_X</th>
        <th>Coordenada_Y</th>
        </tr>";
        echo"<tr>";
        foreach($vehiculo as $dato){
            echo "<td>{$dato}</td>";
        }
        echo"</tr>";


        echo "</table>";
    }

    public function mostrarVehiculosRevision($vehiculo){
        echo"<h3>Pasar revisión al vehículo: {$vehiculo['matricula']}</h3>";
 
    }

    public function mostrarEntregasPendientes($pendientes){
        echo"<h3>Resultado de busqueda:</h3>";
        echo "<table border=1>
        <tr>
        <th>Id</th>
        <th>Matricula</th>
        <th>Conductor</th>
        <th>Localidad</th>
        <th>Kilometros</th>
        <th>Tiempo Máximo</th>
        </tr>";
        echo"<tr>";
        foreach($pendientes as $dato){
            echo "<td>{$dato}</td>";
        }
        echo"</tr>";


        echo "</table>";
        echo "<a href='../control/verEntregaspendientes.php'>Volver</a>";
    }
    public function mostrarAumentoTiempoMazimo($porcentaje, $localidad){
        echo"<h3>Se ha aumentado un {$porcentaje}% el tiempo máximo de entrega en la localidad de: {$localidad}</h3>";
    }
    public function cerrarSesion(){
        echo"<h3>Se ha cerrado la sesion de {$_SESSION['usuario']}</h3>";
        echo "<a href='../index.html'>Menu principal</a>";
    }
    
    


}
?>
