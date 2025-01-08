<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: autenticar.php');
    exit;
}