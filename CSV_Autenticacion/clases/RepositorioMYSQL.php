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
         $stmt=$this->conn->prepare($queryCheck);
         $stmt->bindParam(":score", $score);
         $stmt->execute();
         $result
        if ($result['total'] > 0) {
        // Si el municipio existe, actualiza el registro
        $this->actualizarEstadoMunicipio($nombre_poblacion,
        $personas_afectadas, $comunicaciones_cortadas, $agua,
        $productos_limpieza, $viveres, $medicinas, $otros);
        } else {
        // Si el municipio no existe, inserta un nuevo registro
        $this->insertarEstadoMunicipio($nombre_poblacion,
        $personas_afectadas, $comunicaciones_cortadas, $agua,
        $productos_limpieza, $viveres, $medicinas, $otros);
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
    ) {}
    private function actualizarEstadoMunicipio(
        String $nombre_poblacion,
        int $personas_afectadas,
        int $comunicaciones_cortadas,
        int $agua,
        int $productos_limpieza,
        int $viveres,
        int $medicinas,
        String $otros
    ) {}

    public function obtenerMunicipiosConMasAfectados(): array {}

    public function obtenerNumeroTotalAfectados(): int {}

    public function cerrarConexion(): int {}
}
