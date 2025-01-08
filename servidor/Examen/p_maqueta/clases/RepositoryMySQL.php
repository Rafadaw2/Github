<?php
/*
Importante, 
>Si no hay sustitucion de datos:
    $stmt = $this->conn->query(sentencia)
>Si hay sustitución de datos:
    Primero $stmt = $this->conn->prepare(sentencia)
    los valores a sustituir se pondran en la sentencia como :nombre
    y se sustituyen despues con bindParadam o bindValue
*/

class RepositoryMySQL
{
    private $conn;

    public function __construct($host, $dbname, $user, $password)
    {
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    public function autenticarUsuario($usuario)
    {
        $stmt = $this->conn->prepare("SELECT *
                                     FROM ADMINISTRADOR a
                                     WHERE a.id_admin=:usuario");
        //Se usa bindaValue cuando el dato no va a cambiar es fijo
        $stmt->execute([':usuario' => $usuario]);
        $resultado=$stmt->fetch(PDO::FETCH_ASSOC);
        if($resultado){
            return $resultado;
        }else{
            return -1;
        }

    }

    public function obtenerVehiculosNoDisponibles()
    {
        $stmt = $this->conn->query("SELECT COUNT(*) as v_no_disponibles
                                   FROM ENTREGA e
                                   WHERE e.tiempo_real IS NULL");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerVehiculosDisponibles()
    {
        $stmt = $this->conn->query("SELECT COUNT(DISTINCT e.id_vehiculo) as v_disponibles
                                   FROM VEHICULO v JOIN ENTREGA e
                                   ON v.id_vehiculo=e.id_vehiculo
                                   WHERE e.tiempo_real IS NOT NULL");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerEntregasPendientes()
    {
        $stmt = $this->conn->query("SELECT COUNT(e.id) as e_pendientes
                                   FROM ENTREGA e
                                   WHERE e.tiempo_real IS NULL");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerMediaTiempoReal()
    {
        $stmt = $this->conn->query("SELECT AVG(e.tiempo_real) as promedio_t_real
                                   FROM ENTREGA e
                                   WHERE e.tiempo_real IS NOT NULL");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerMediaTiempoMaximo()
    {
        $stmt = $this->conn->query("SELECT AVG(e.tiempo_maximo) as promedio_t_maximo
                                   FROM ENTREGA e
                                   WHERE e.tiempo_real IS NOT NULL");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerPrevisionMantenimiento()
    {
        $stmt = $this->conn->query("SELECT v.matricula, SUM(e.kilometros) AS km, 1000-SUM(e.kilometros) as km_restantes
                                   FROM VEHICULO v JOIN ENTREGA e
                                   ON v.id_vehiculo=e.id_vehiculo
                                   GROUP BY v.matricula ");
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerCiudadMasEntregas()
    {
        $stmt = $this->conn->query("SELECT e.localidad, COUNT(e.id) AS n_entregas
                                   FROM ENTREGA e
                                   GROUP BY e.localidad
                                   ORDER BY n_entregas DESC
                                   LIMIT 1");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerCosteConductor()
    {
        $stmt = $this->conn->query("SELECT e.id_conductor, c.nombre, SUM(e.kilometros) as entregas, SUM(e.kilometros)*2 as coste
                                   FROM ENTREGA e JOIN CONDUCTOR c
                                   ON e.id_conductor=c.id_conductor
                                   WHERE e.tiempo_real IS NOT NULL
                                   GROUP BY e.id_conductor");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPosicionVehiculos()
    {
        $stmt = $this->conn->query("SELECT v.matricula, v.coordenada_x, v.coordenada_y
                                   FROM VEHICULO v JOIN ENTREGA e
                                   ON v.id_vehiculo=e.id_vehiculo
                                   WHERE v.coordenada_x != 0 and v.coordenada_y != 0 and e.tiempo_real is null ");
        $stmt->execute();                           
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerDatosVehiculo($matricula)
    {
        $stmt = $this->conn->prepare("SELECT *
                                   FROM VEHICULO v
                                   WHERE v.matricula = :matricula ");
        $stmt->execute([':matricula' => $matricula]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertarCondcutor($id, $nombre, $telefono)
    {
        $stmt = $this->conn->prepare("INSERT INTO CONDUCTOR(id_conductor, nombre, telefono)
                                   VALUES (:id, :nombre, :telefono)");
        $stmt->execute([':id' => $id, ':nombre' => $nombre, ':telefono' => $telefono]);
    }

    public function insertarVehiculo($id, $tipo, $matricula, $alarma, $coordenada_x, $coordenada_y)
    {
        $stmt = $this->conn->prepare("INSERT INTO VEHICULO(id_vehiculo, tipo, matricula, alarma_revision, coordenada_x, coordenada_y)
                                   VALUES (:id, :tipo, :matricula, :alarma, :coordenada_x, :coordenada_y)");
        $stmt->execute([':id'=>$id, ':tipo'=>$tipo, ':matricula'=>$matricula, ':alarma'=>$alarma,
         ':coordenada_x'=>$coordenada_x, ':coordenada_y'=>$coordenada_y]);
    }

    public function insertarRegistro($id_admin, $fecha_subida, $num_vehiculos_nuevos, $num_conductores_nuevos)
    {
        $stmt = $this->conn->prepare("INSERT INTO LOG (id_admin, fecha_subida, num_vehiculos_nuevos, num_conductores_nuevos)
                                   VALUES (:id_admin, NOW(), :num_vehiculos_nuevos, :num_conductores_nuevos)");
        $stmt->execute([':id_admin'=>$id_admin,':num_vehiculos_nuevos'=>$num_vehiculos_nuevos,
         ':num_conductores_nuevos'=>$num_conductores_nuevos]);
    }

    public function obtenerVehiculosPendienteRevision()
    {
        $stmt = $this->conn->query("SELECT v.matricula, SUM(e.kilometros) as km
                                   FROM VEHICULO v JOIN ENTREGA e
                                   ON v.id_vehiculo=e.id_vehiculo
                                   GROUP BY v.matricula
                                   HAVING SUM(e.kilometros)>1000");
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado ? $resultado : null;
    }

    public function obtenerPendientesConductor($id)
    {
        $stmt = $this->conn->prepare("SELECT e.id_conductor, v.matricula, c.nombre, e.localidad, e.kilometros, e.tiempo_maximo
                                   FROM VEHICULO v JOIN ENTREGA e
                                   ON v.id_vehiculo=e.id_vehiculo
                                   JOIN CONDUCTOR c 
                                   ON e.id_conductor=c.id_conductor
                                   WHERE e.tiempo_real IS NULL and e.id_conductor=:id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerPendientesVehiculo($id)
    {
        $stmt = $this->conn->prepare("SELECT e.id_conductor, v.matricula, c.nombre, e.localidad, e.kilometros, e.tiempo_maximo
                                   FROM VEHICULO v JOIN ENTREGA e
                                   ON v.id_vehiculo=e.id_vehiculo
                                   JOIN CONDUCTOR c 
                                   ON e.id_conductor=c.id_conductor
                                   WHERE e.tiempo_real IS NULL and e.id_vehiculo=:id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function aumentarTiempoMaximo($porcentaje, $localidad)
    {
        $stmt = $this->conn->prepare("UPDATE ENTREGA 
        SET tiempo_maximo = tiempo_maximo*(1+ :porcentaje /100)
        WHERE tiempo_real IS NULL and localidad=:localidad");
        $stmt->execute([':porcentaje' => $porcentaje,':localidad'=>$localidad]);
    }

}

