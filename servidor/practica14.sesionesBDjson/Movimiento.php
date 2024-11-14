<?php
class Movimiento{
    private $fila,$columna;
    public function __construct(int $fila, $columna) {
        $this->fila=$fila;
        $this->columna=$columna;
    }
    public function getFila():int{
        return $this->fila;
    }
    public function getColumna() :int {
        return $this->columna;
    }
}