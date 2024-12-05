<?php

class MeteoritoModel {
    private string $name;
    private string $closeApproachDate;
    private string $tamano;
    private string $velocidad;

    // Constructor para inicializar los atributos
    public function __construct(string $name, string $closeApproachDate, string $tamano, string $velocidad) {
       $this->name=$name;
       $this->closeApproachDate=$closeApproachDate;
       $this->tamano=$tamano;
       $this->velocidad=$velocidad;
    }

    // Métodos getter
    public function getName(): string {
      return $this->name;
    }

    public function getCloseApproachDate(): string {
        return $this->closeApproachDate;
    }

    public function getTamano(): string {
        return $this->tamano;
    }

    public function getVelocidad(): string {
        return $this->velocidad;
    }
}
