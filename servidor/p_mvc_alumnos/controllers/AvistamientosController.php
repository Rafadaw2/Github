<?php
// Imports completar
require_once "./models/AvistamientosMeteoritosModel.php";
require_once "./views/ImpactoView.php";
require_once "./views/ResultadoBusquedaMeteoritoView.php";



class AvistamientosController {
    private $modelo;
    private $vistaImpacto;
    private $vistaResultadoBusqueda;

    
    public function __construct() {
       //Completar
       $this->modelo=new AvistamientosMeteroritosModel();
       $this->vistaImpacto= new ImpactoView();
       $this->vistaResultadoBusqueda=new ResultadoBusquedaMeteoritoView();
    }

    public function buscar($nombreMeteorito) {
        
        // 1 Obtener resultados desde el modelo 
        $resultado=$this->modelo->buscarMeteoritos($nombreMeteorito);
       

        // 2 Mostrar la vista con los resultados
        $this->vistaResultadoBusqueda->render($resultado);
    
       
    }
    public function obtenerImpacto($tam,$velocidad){
        //Completar
        $impacto=$this->modelo->calcularEnergiaImpacto($tam,$velocidad);
        $this->vistaImpacto->render($impacto);

    }
}
