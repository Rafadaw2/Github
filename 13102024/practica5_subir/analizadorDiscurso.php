<?php

class AnalizadorDiscurso
{
    private $discurso;

    public function __construct($discurso="") {
        $this->discurso=$discurso;
    }

    public function agregarDiscurso($discursoEntrada){
        $this->discurso=$discursoEntrada;
    }

    public function analizar(){
        
            //Convertimos a minúsculas
            $texto_minusculas=strtolower($this->discurso);
            
            //Eliminamos signos de puntuacion y palabras vacias.
            $signos_pvacias= [" la ", " el ", " los ", " las ", " un ", 
            " una ", " unos ", " unas ", " que "," qué ", " de ", " en ", " y ", " a ", 
            " es ", " por ", " con ", " se ", " como ", " no ", " lo ", " su ", 
            " al ", " le ",".",",","?","¿","!","¡","..."];
            $texto_limpio=str_replace($signos_pvacias," ",$texto_minusculas);

        
            //preg_replace
        
            //Dividimos el texto en un array de palabras
            $array_texto=explode(" ",$texto_limpio,100000);

            /*foreach($array_texto as &$palabra){
                $palabra=trim($palabra);
                if($palabra==" "){
                    unset($palabra);
                }
            }*/
            $array_limpio=array_filter($array_texto,function($palabra){
                return trim($palabra)!=="";
            });
            $array_limpio=array_values($array_limpio);
            /*Puedo usar array_count_values, nos devuelve un array asociativo
            con las posiciones como key y las repeticiones como valor*/
            $palabra_repeticiones=array_count_values($array_limpio);
        
            //Ordenamos de mayor a menor.
            arsort($palabra_repeticiones);
            
            //Lo ideal es que la funcion devuelva un array, puedo hacerlo con array_sliceç
            $palabrasImp=array_slice($palabra_repeticiones,0,3);
        
            return $palabrasImp;
        
        
    }
}