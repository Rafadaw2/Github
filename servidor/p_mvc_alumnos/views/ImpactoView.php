

<?php

require_once 'ViewInterface.php';
class ImpactoView implements ViewInterface{

    // Método que renderiza la página de resultados
    public function render($resultado) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Resultados de Meteoritos</title>
        </head>
        <body>
            <h1>Energía de Impacto</h1> ';

        // Condicional para mostrar el resultado o un mensaje de error
        if (empty($resultado)) {
            echo '<p>No se encontraron meteoritos con los criterios proporcionados.</p>';
        } else {
            // Escapar caracteres especiales para prevenir inyecciones XSS
            $energia = htmlspecialchars($resultado);
            echo "<strong>Energía liberada:</strong> {$energia} julios<br>";
        }

        echo <<<HTML
            <a href="index.php">Volver</a>
        </body>
        </html>
        HTML;
    }
}

