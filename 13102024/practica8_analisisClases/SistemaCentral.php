<?php
abstract class VehiculoAutonomo{
    protected $id;
    protected $coordenadas=[];
    protected $nivelBateria;

    public function __construct($id, $coordenadas, $nivelBateria) {
        $this->id=$id;
        $this->coordenadas=$coordenadas;
        $this->nivelBateria=$nivelBateria;
    }
    public function getId() {
        return $this->id;
    }
    public function getCoordenadas(){
        return $this->coordenadas;
    }

    public function setCoordenadas($coordenadas){
        $this->coordenadas=$coordenadas;
    }

    public function gerNivelBateria(){
        return $this->nivelBateria;
    }

    public function recargarBateria() {
        $this->nivelBateria=100;
    }

    abstract function mover($nuevasCoordenadas);
    abstract function mostrarTipoVehiculo();

}

class Dron extends VehiculoAutonomo{
    private $motores=[];

    public function __construct($id, $coordenadas, $nivelBateria) {
        parent::__construct($id,$coordenadas,$nivelBateria);
        $this->motores=[1,1,1,1];
    }

    public function supervisar(){
        for($i=0;i<count($motores);$i++){
            if($motores[$i]!=1){
                echo "El motor ".$i." no funciona.</br>";
            }
        }
    }
    public function mover($nuevasCoordenadas) {
        echo "El dron se mueve de ". implode(",",$this->coordenadas)." a ".implode(",",$nuevasCoordenadas)."</br>";
        $this->coordenadas=$nuevasCoordenadas;
    }
    public function mostrarTipoVehiculo()  {
        echo "Esto es un dron.</br>";
    }
}

class Coche extends VehiculoAutonomo{
    private $supervision_conductor;
    
    public function __construct($id,$coordenadas,$nivelBateria) {
        parent::__construct($id,$coordenadas,$nivelBateria);
        $this->supervision_conductor="ok";
    }
    public function mover($nuevasCoordenadas)  {
        echo "El coche se mueve de ". implode(",",$this->coordenadas)." a ".implode(",",$nuevasCoordenadas)."</br>";
        $this->coordenadas=$nuevasCoordenadas;
    }
    public function mostrarTipoVehiculo()  {
        echo "Esto es un coche.</br>";
    }

}

class CentralRecarga {
    private $id;
    private $coordenadasCentral;

    public function __construct($id,$coordenadasCentral) {
        $this->id=$id;
        $this->coordenadasCentral =$coordenadasCentral;
    }

    public function getId() {
        return $this->id;
    }

    public function getCoordenadas(){
        return $this->coordenadasCentral;
    }
}

class SistemaCentral{
    private $vehiculos=[];
    private $centralesRecarga=[];

    public function __construct() {
        /*Al no pasarle parametros de entrada y no tener nada 
        que hacer en el contructor podría dejarlo vacio o eliminarlo*/
    }

    public function agregarVehiculo($vehiculo) {
        $this->vehiculos[$vehiculo->getId()]=$vehiculo;
    }

    public function agregarCentralRecarga($centralRecarga) {
        $this->centralesRecarga[$centralRecarga->getId()]=$centralRecarga;
    }

    public function mostrarVehiculos() {
        foreach ($this->vehiculos as $vehiculo) {
            echo print_r($vehiculo)."</br>";
            
        }
    }

    public function encontrarCentralCercana($coordenadasVehiculo)  {
        $coordenadasCentralMasCercana;
        $menorDistancia=PHP_INT_MAX;//Da como valor el mayor que existe
        
        foreach($this->centralesRecarga as $central){
            $distancia=$this->calcularDistancia($coordenadasVehiculo,$central->getCoordenadas());
            if($distancia<=$menorDistancia){
                $menorDistancia=$distancia;
                $coordenadasCentralMasCercana=$central->getCoordenadas();
            }
        }
        return $coordenadasCentralMasCercana;
    }

    public function calcularDistancia($coordenadasA,$coordenadasB)  {
        $coordenadasXA=$coordenadasA[0];
        $coordenadasYA=$coordenadasA[1];
        $coordenadasXB=$coordenadasB[0];
        $coordenadasYB=$coordenadasB[1];

        /*Se puede calcular la distancia por medio de la raiz cuadrada la suma del cuadrado de la diferencia entre
        las coordenadas x e y */

        $distancia=pow(($coordenadasXA-$coordenadasXB),2)+pow(($coordenadasYA-$coordenadasYB),2);
        $distancia=sqrt($distancia);
        return $distancia;
    }

    public function recargarVehiculo($idVehiculo) {

        if(isset($this->vehiculos[$idVehiculo])){
        $vehiculo=$this->vehiculos[$idVehiculo];
        $coordenadasVehiculo=$this->vehiculos[$idVehiculo]->getCoordenadas();
        $coordenadasCentralMasCercana=$this->encontrarCentralCercana($coordenadasVehiculo);
        }else{
            echo "El vehículo no ha sido encontrado.</br>";
        }
        if($coordenadasCentralMasCercana){
        $vehiculo->mover($coordenadasCentralMasCercana);
        $vehiculo->recargarBateria();
        echo "Recargando el vehículo en la central más cercana : ".implode(",",$coordenadasCentralMasCercana)."</br>";
        }else{
            echo"No hay centrales de carga disponibles.</br>";
        }
    }
}

?>