<?php

require_once 'ViewInterface.php';
class MeteoritoBusquedaView implements ViewInterface {
    
    // Método que renderiza el formulario HTML
    public function render($datos) {
       echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Buscar Meteoritos</title>
        </head>
        <body>
            <h1>Búsqueda de Meteoritos</h1>
            <form method="GET" action="index.php">
                <input type="hidden" name="action" value="buscar">
                <label for="nombre">Nombre del Meteorito:</label>
                <input type="text" name="nombre" id="nombre">
                <br><br>
                <button type="submit">Buscar</button>
            </form>
        </body>
        </html>';
        
    }
}