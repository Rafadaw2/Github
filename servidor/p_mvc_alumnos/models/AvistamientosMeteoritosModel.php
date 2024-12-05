<?php
require_once 'MeteoritoModel.php';

class AvistamientosMeteroritosModel
{
    private $meteoritos = [];



    public function __construct()
    {

        // Inicialización del modelo
        $this->meteoritos[0] = new MeteoritoModel('Apophis', '2029-04-13', '370m', '30.78km/h');
        $this->meteoritos[1] = new MeteoritoModel('Bennu', '2135-09-25', '500m', '28.48km/h');
        $this->meteoritos[2] = new MeteoritoModel('Ryugu', '2023-08-15', '900m', '0.19km/h');
        $this->meteoritos[3] = new MeteoritoModel('Elenin', '2029-10-19', '300m', '21.13km/h');
        $this->meteoritos[4] = new MeteoritoModel('Itokawa', '2021-11-22', '535m', '18.2km/h');
    }


    public function buscarMeteoritos($nombre = "")
    {

        foreach ($this->meteoritos as $meteorito) {

            if ($meteorito->getName() == $nombre) {
                $resultado=$meteorito;
            }
        }
        // Completa esta función para buscar un meteorito y devolverlo

        return $resultado;
    }


    public function obtenerMeteoritos()
    {
        return $this->meteoritos;
    }

    /**
     * Calcula la energía liberada por el impacto de un meteorito.
     * 
     * @param string $nombre Nombre del meteorito.
     * @return float Energía liberada en julios.
     */

    public function calcularEnergiaImpacto($tam, $vel)
    {


        $tamano = $tam;
        $velocidad = $vel; // Velocidad en km/h, como '30.78km/h'

        // Convertir tamaño de formato '370m' a valor numérico
        $tamano = (float) rtrim($tamano, 'm');

        // Convertir la velocidad de km/h a m/s
        $velocidad = (float) rtrim($velocidad, 'km/h');
        $velocidad = $velocidad * 1000 / 3600; // km/h a m/s

        // Calcular el volumen de la esfera del meteorito (suponiendo que es esférico)
        $radio = $tamano / 2;
        $volumen = (4 / 3) * pi() * pow($radio, 3);

        // Asumimos una densidad promedio de 3000 kg/m³ para el meteorito
        $densidad = 3000; // en kg/m³

        // Calcular la masa del meteorito (m = densidad * volumen)
        $masa = $densidad * $volumen;

        // Calcular la energía cinética (E = 1/2 * m * v^2)
        $energia = 0.5 * $masa * pow($velocidad, 2);

        return $energia;
    }
}
