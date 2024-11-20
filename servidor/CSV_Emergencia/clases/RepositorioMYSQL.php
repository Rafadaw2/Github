<?php

class RepositorioMYSQL
{
    private $conn;

    public function __construct($servername, $dbname, $username, $password)
    {
        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function obtenerUltimaFechaReporte($municipio)
    {
        // Este select solo puede dar un registro
        $query = "SELECT fecha_reporte FROM estado_municipios
        WHERE nombre_poblacion = '$municipio' ORDER BY fecha_reporte
        DESC LIMIT 1";
        $result = $this->conn->query($query);
        if ($result && $row = $result->fetch()) {
            return strtotime($row['fecha_reporte']);
        } else
            return null;
    }
    public function guardarEstadoMunicipio(
        String $nombre_poblacion,
        int $personas_afectadas,
        int $comunicaciones_cortadas,
        int $agua,
        int $productos_limpieza,
        int $viveres,
        int $medicinas,
        String $otros
    ) {
        // Primero, comprueba si el municipio ya existe
        $queryCheck = "SELECT COUNT(*) AS total FROM
        estado_municipios WHERE nombre_poblacion = :nombre_poblacion";
        $stmt = $this->conn->prepare($queryCheck);
        $stmt->bindParam(":nombre_poblacion", $nombre_poblacion);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['total'] > 0) {
            // Si el municipio existe, actualiza el registro
            $this->actualizarEstadoMunicipio(
                $nombre_poblacion,
                $personas_afectadas,
                $comunicaciones_cortadas,
                $agua,
                $productos_limpieza,
                $viveres,
                $medicinas,
                $otros
            );
        } else {
            // Si el municipio no existe, inserta un nuevo registro
            $this->insertarEstadoMunicipio(
                $nombre_poblacion,
                $personas_afectadas,
                $comunicaciones_cortadas,
                $agua,
                $productos_limpieza,
                $viveres,
                $medicinas,
                $otros
            );
        }
    }
    private function insertarEstadoMunicipio(
        String $nombre_poblacion,
        int $personas_afectadas,
        int $comunicaciones_cortadas,
        int $agua,
        int $productos_limpieza,
        int $viveres,
        int $medicinas,
        String $otros
    ) {
        $queryInsert = "INSERT INTO estado_municipios
        (nombre_poblacion, personas_afectadas, comunicaciones_cortadas,
        agua, productos_limpieza, viveres, medicinas, otros)
        VALUES (:nombre_poblacion,
        :personas_afectadas, :comunicaciones_cortadas, :agua,
        :productos_limpieza, :viveres, :medicinas, :otros)";

        $stmt = $this->conn->prepare($queryInsert);

        $stmt->execute([
            "nombre_poblacion" => $nombre_poblacion,
            "personas_afectadas" => $personas_afectadas,
            "comunicaciones_cortadas" => $comunicaciones_cortadas,
            "agua" => $agua,
            "productos_limpieza" => $productos_limpieza,
            "viveres" => $viveres,
            "medicinas" => $medicinas,
            "otros" => $otros
        ]);
    }
    private function actualizarEstadoMunicipio(
        String $nombre_poblacion,
        int $personas_afectadas,
        int $comunicaciones_cortadas,
        int $agua,
        int $productos_limpieza,
        int $viveres,
        int $medicinas,
        String $otros
    ) {
        $queryUpdate = "UPDATE estado_municipios SET
        personas_afectadas =
        :personas_afectadas,
        comunicaciones_cortadas =
        :comunicaciones_cortadas,
        agua = :agua,
        productos_limpieza =
        :productos_limpieza,
        viveres = :viveres,
        medicinas = :medicinas,
        otros = :otros
        WHERE nombre_poblacion =
        :nombre_poblacion";

        $stmtUpdate = $this->conn->prepare($queryUpdate);

        // Vincular parámetros
        $stmtUpdate->bindParam(':nombre_poblacion',
        $nombre_poblacion);
        $stmtUpdate->bindParam(':personas_afectadas',
        $personas_afectadas);
        $stmtUpdate->bindParam(':comunicaciones_cortadas',
        $comunicaciones_cortadas);
        $stmtUpdate->bindParam(':agua', $agua);
        $stmtUpdate->bindParam(':productos_limpieza',
        $productos_limpieza);
        $stmtUpdate->bindParam(':viveres', $viveres);
        $stmtUpdate->bindParam(':medicinas', $medicinas);
        $stmtUpdate->bindParam(':otros', $otros);

        $stmtUpdate->execute();
    }

    public function obtenerMunicipiosConMasAfectados():array {
        $sentencia="SELECT * FROM estado_municipios ORDER BY personas_afectadas";
        $stmt = $this->conn->query($sentencia);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
       

    }

    public function obtenerNumeroTotalAfectados(): int {
        $sentencia="SELECT SUM(personas_afectadas) AS suma FROM estado_municipios ORDER BY personas_afectadas";
        $stmt = $this->conn->query($sentencia);
        
        
        if ($stmt !== false) {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$row['suma']; // Retorna la suma como un entero
            }
            // En caso de que la consulta falle, devolver 0 o lanzar una excepción
            return 0;
    }

    public function cerrarConexion() {
        $conn=null;
    }
}
