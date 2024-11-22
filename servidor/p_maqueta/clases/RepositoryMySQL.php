<?php

use function MongoDB\select_server;

class RepositorioMYSQL
{
    private $conn;

    public function __construct($servername, $dbname, $username, $password)
    {
        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function obtenerVehiculosDisponibles()
    {
        // Este select solo puede dar un registro
        $query = "SELECT  COUNT(e.id_vehiculo) as num
                    FROM ENTREGA e
                    WHERE tiempo_real is null";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerVehiculosNoDisponibles()
    {
        $query = "SELECT  COUNT(e.id_vehiculo) as num
                    FROM ENTREGA e
                    WHERE tiempo_real is not null";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerEntregasPendientes()
    {
        $query = "SELECT  COUNT(*) as num
        FROM ENTREGA e
        WHERE tiempo_real is null";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    public function obtenerEntregasCompletadas() {
        $query = "SELECT  * 
        FROM ENTREGA e
        WHERE tiempo_real is not null";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerEntregasNoCompletadas() {
        $query = "SELECT  * 
        FROM ENTREGA e
        WHERE tiempo_real is null";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    /*public function obtenerEntregasEnTiempo($tiempoMedio) {
        $query = "SELECT  *
        FROM ENTREGA e
        WHERE tiempo_real is not null and tiempo_real<:tiempoMedio";
        $result = $this->conn->prepare($query);
        $result->bindParam(':tiempoMedio', $tiempoMedio, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }*/
    public function obtenerKmVehiculos() {
        $query = "SELECT  v.matricula,e.kilometros
        FROM VEHICULO v JOIN ENTREGA e
        on v.id_vehiculo=e.id_vehiculo";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtenerCiudadConMasEntregas($limite=1) {
        $stmt = $this->conn->prepare("
        SELECT e.localidad, COUNT(*) AS num
        FROM ENTREGA e
        GROUP BY e.localidad
        ORDER BY num DESC
        LIMIT :limite
    ");
    $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function obtenerKilometrosConductor() {
        $query = "SELECT  c.nombre, SUM(e.kilometros)
        FROM CONDUCTOR c JOIN ENTREGA e
        on c.id_conductor=e.id_conductor
        /*WHERE e.tiempo_real IS NOT NULL*/
        GROUP BY c.nombre";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertarVehiculos($vehiculos) {
        foreach($vehiculos as $vehiculo){
            
        $queryInsert = "INSERT INTO VEHICULO
        (id_vehiculo, tipo, matricula, alarma_revision, coordenada_x, coordenada_y)
        VALUES (:id_vehiculo,
        :tipo, :matricula, :alarma_revision,
        :coordenada_x,:coordenada_y)";

        $stmt = $this->conn->prepare($queryInsert);

        $stmt->execute([
            "id_vehiculo" => $vehiculo['id_vehiculo'],
            "tipo" => $vehiculo['tipo'],
            "matricula" => $vehiculo['matricula'],
            "alarma_revision" => $vehiculo['alarma_revision'],
            "coordenada_x" => $vehiculo['coordenada_x'],
            "coordenada_y" => $vehiculo['coordenada_y']
        ]);
        }
    }
    public function insertarConductores($conductores) {
        foreach($conductores as $conductor){
            
        $queryInsert = "INSERT INTO CONDUCTOR
        (id_conductor, nombre, telefono)
        VALUES (:id_conductor,
        :nombre, :telefono";

        $stmt = $this->conn->prepare($queryInsert);
            
        $stmt->execute([
            "id_conductor" => $conductor['id_conductor'],
            "nombre" => $conductor['nombre'],
            "telefono" => $conductor['telefono']
        ]);
        }
    }
    public function vehiculosPendientesRevision() {
        $query = "SELECT e.id_vehiculo, v.matricula, SUM(e.kilometros) as km
        FROM VEHICULO v JOIN ENTREGA e
        ON v.id_vehiculo=e.id_vehiculo
        GROUP BY e.id_vehiculo";
        $result = $this->conn->query($query);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function incrementarTiempoMaximoPendientes($id_entrega,$tiempo_maximo_actualizado)  {
        
        $queryUpdate = "UPDATE ENTREGA SET
        tiempo_maximo =:tiempo_maximo
        WHERE id=:id_entrega";

        $stmtUpdate = $this->conn->prepare($queryUpdate);

        // Vincular parámetros
        $stmtUpdate->bindParam(':id_entrega', $id_entrega);
        $stmtUpdate->bindParam(':tiempo_maximo', $tiempo_maximo_actualizado);

        $stmtUpdate->execute();
        
    }

    public function cerrarConexion()
    {
        $conn = null;
    }
}
