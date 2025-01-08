<?php
class RepositoryMySQL
{
    private $conn;
    public function __construct($host, $usuario, $pass, $db)
    {
        $this->conn = new PDO(
            "mysql:host=$host;dbname=$db",
            $usuario,
            $pass
        );

        $this->conn->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    //Funcion para ver todos los usuarios autorizados
    public function findAllAdmins()
    {
        $query = '
        SELECT * FROM ADMINISTRADOR
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    //Funcion para ver los disp. de la flota
    public function disponiblesFlota()
    {
        $query = '
        SELECT COUNT(v.id_vehiculo) as total_disponibles FROM VEHICULO v
        JOIN ENTREGA e ON v.id_vehiculo=e.id_vehiculo
        WHERE e.tiempo_real IS NULL
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalVehiculos()
    {
        $query = '
        SELECT COUNT(id_vehiculo) as totales FROM VEHICULO
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $totales = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $disponibles = $this->disponiblesFlota();

        //Todos menos los disp son los no disples

        return $totales[0];
    }

    public function entregasEnProceso()
    {
        $query = '
        SELECT COUNT(id) as total
        FROM ENTREGA 
        WHERE tiempo_real IS NULL
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function promedioTiempoReal()
    {
        $query = '
        SELECT AVG(tiempo_real) as tiempo_real
        FROM ENTREGA 
        WHERE tiempo_real IS NOT NULL
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function promedioTiempoMaximo()
    {
        $query = '
        SELECT AVG(tiempo_maximo) as tiempo_maximo
        FROM ENTREGA 
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function kmsTotales()
    {
        $query = '
        SELECT SUM(e.kilometros) as kilometros, v.matricula
        FROM ENTREGA e JOIN VEHICULO v 
        ON e.id_vehiculo=v.id_vehiculo
        GROUP BY v.matricula
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function ciudadMasEntregas()
    {
        $query = '
        SELECT COUNT(id) as total, localidad FROM ENTREGA
        GROUP BY localidad
        ORDER BY total DESC
        LIMIT 1
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function costePorConductor()
    {
        $query = '
        SELECT c.nombre , SUM(e.kilometros) as total 
        FROM CONDUCTOR c JOIN ENTREGA e
        ON c.id_conductor=e.id_conductor
        GROUP BY c.id_conductor
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function posicionVehiculosEnRuta()
    {
        $query = '
        SELECT coordenada_x, coordenada_y, matricula FROM VEHICULO v
        JOIN ENTREGA e ON v.id_vehiculo=e.id_vehiculo
        WHERE tiempo_real IS NULL
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function insertVehiculos($id, $matricula, $tipo)
    {
        if (strlen($matricula) == 8) {
            $query = '
        INSERT INTO VEHICULO(id_vehiculo, matricula, tipo, alarma_revision, coordenada_x, coordenada_y)
         VALUES(:id, :matricula, :tipo,0,0,0)
        ';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':tipo', $tipo);


            $stmt->execute();
        }
    }


    public function insertConductor($id, $nombre, $tlf)
    {
        $query = '
        INSERT INTO CONDUCTOR(id_conductor, telefono, nombre)
        VALUES(:id, :tlf, :nombre)
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tlf', $tlf);
        $stmt->bindParam(':nombre', $nombre);


        $stmt->execute();
    }

    public function insertLog($id, $nVehiculos, $nConductores)
    {
        $query = '
        INSERT INTO LOG(id_admin, fecha_subida, num_vehiculos_nuevos, num_conductores_nuevos)
        VALUES(:id, NOW(), :nVehiculos, :nConductores)
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nVehiculos', $nVehiculos);
        $stmt->bindParam(':nConductores', $nConductores);


        $stmt->execute();
    }

    public function vehiculosRevision(){
        $query = '
        SELECT SUM(e.kilometros) as kilometros, v.matricula
        FROM VEHICULO v JOIN ENTREGA e 
        ON v.id_vehiculo=e.id_vehiculo
        GROUP BY v.matricula
        ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function buscarPorConductor($id){
        $query = '
        SELECT e.id, v.matricula, c.nombre, e.localidad, e.kilometros, e.tiempo_maximo
        FROM VEHICULO v JOIN ENTREGA e 
        ON v.id_vehiculo=e.id_vehiculo JOIN CONDUCTOR c
        ON e.id_conductor=c.id_conductor
        WHERE c.id_conductor=:id
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function buscarPorVehiculo($id){
        $query = '
        SELECT e.id, v.matricula, c.nombre, e.localidad, e.kilometros, e.tiempo_maximo
        FROM VEHICULO v JOIN ENTREGA e 
        ON v.id_vehiculo=e.id_vehiculo JOIN CONDUCTOR c
        ON e.id_conductor=c.id_conductor
        WHERE v.id_vehiculo=:id
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function retrasoPorLocalidad($localidad){
        $query = '
        UPDATE ENTREGA 
        SET tiempo_maximo=tiempo_maximo*0.2
        WHERE localidad=:localidad
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':localidad', $localidad);

        $stmt->execute();

    }

    public function datosMatricula($matricula){
        $query = '
        SELECT * FROM VEHICULO
        WHERE matricula=:matricula
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':matricula', $matricula);

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
