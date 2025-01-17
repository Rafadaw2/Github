<?php
require "../clases/VistaHTML.php";
session_start();
$vista = new VistaHTML();
$vista->cerrarSesion();
session_destroy();