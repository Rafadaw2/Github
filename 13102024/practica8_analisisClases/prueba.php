<?php
include "./SistemaCentral.php";

//Instancia SistemaCentral

$SM= new SistemaCentral();

// 2.- crea un Dron en coordenadas [10,20] y un Coche en coordenadas [30,40]

$dron1= new Dron(1,[10,20],100);
$coche1= new Coche(2,[30,40],100);

//3.-Agrega los vehículos en el Sistema central

$SM->agregarVehiculo($dron1);
$SM->agregarVehiculo($coche1);

//Agrega una central de recarga en [15,25] y [35,45]

$central1= new CentralRecarga(1,[15,25]);
$central2= new CentralRecarga(2,[35,45]);

$SM->agregarCentralRecarga($central1);
$SM->agregarCentralRecarga($central2);

// Muestra los vehículos que tiene el sistema

$SM->mostrarVehiculos();

// Recarga el dron

$SM->recargarVehiculo($dron1->getId());

// Recarga el coche

$SM->recargarVehiculo($coche1->getId());

/*Cuestiones
a) ¿ Por qué la clase Vehículo es abstracta?
Porque contine almenos un metodo abstracto.
b) ¿ Por qué las siguientes funciones son abstractas?
Porque se declaran en la superclase pero no se definen, se definen
en las subclases.
*/
?>