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

            /*str_replace busca las cadenas de un array dentro de otro y las reemplaza por lo que quieras*/
            $texto_limpio=str_replace($signos_pvacias," ",$texto_minusculas);

        
            //preg_replace
        
            //Dividimos el texto en un array de palabras
            $array_texto=explode(" ",$texto_limpio,100000);

            //trim() elimina espacios por delante y por detras de la palabra
            /*foreach($array_texto as &$palabra){
                $palabra=trim($palabra);
                if($palabra==" "){
                    unset($palabra);
                }
            }*/
            //Procesa cada elemento de un array y le aplica la funcion indicada
            $array_limpio=array_filter($array_texto,function($palabra){
                return trim($palabra)!=="";
            });

            //array_values sirve para resetear los indices del array y sean secuenciales
            $array_limpio=array_values($array_limpio);

            /*Puedo usar array_count_values, nos devuelve un array asociativo
            con las posiciones como key y las repeticiones como valor*/
            $palabra_repeticiones=array_count_values($array_limpio);
        
            //Ordenamos de mayor a menor.
            arsort($palabra_repeticiones);
            
            /*Lo ideal es que la funcion devuelva un array, puedo hacerlo con array_slice
            pasando el array y el intervalo de posiciones que quieres extraer*/
            $palabrasImp=array_slice($palabra_repeticiones,0,3);
        
            return $palabrasImp;
        
        
    }

}
/* sort(array &$array, int $flags = SORT_REGULAR): bool
$array: El array que deseas ordenar.
$flags (opcional): Un indicador que modifica el comportamiento del ordenamiento. Puede tomar valores como:
SORT_REGULAR (por defecto): Compara los elementos normalmente.
SORT_NUMERIC: Compara elementos numéricamente.
SORT_STRING: Compara elementos como cadenas.
SORT_LOCALE_STRING: Compara cadenas según la configuración regional.
SORT_NATURAL: Compara elementos usando el "orden natural".
SORT_FLAG_CASE: Puede usarse junto con SORT_STRING para una comparación insensible a mayúsculas y minúsculas. 

Otras funciones de ordenamiento relacionadas
rsort: Ordena en orden descendente.
asort: Ordena preservando los índices de los elementos.
arsort: Ordena en orden descendente preservando los índices.
ksort: Ordena un array por sus claves.
krsort: Ordena un array por sus claves en orden descendente.
usort: Permite usar una función personalizada para definir el orden.*/