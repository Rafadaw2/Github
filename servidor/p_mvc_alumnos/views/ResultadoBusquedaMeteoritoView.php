<?php
require_once 'ViewInterface.php';
class ResultadoBusquedaMeteoritoView implements ViewInterface {

    // Método que renderiza la página de resultados
    public function render($meteorito_seleccionado) {
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Resultados de Meteoritos</title>
        </head>
        <body>
            <h1>Resultados de Búsqueda</h1>
HTML;

        // Verificar si el resultado está vacío
        if (empty($meteorito_seleccionado)) {
            echo '<p>No se encontraron meteoritos con los criterios proporcionados.</p>';
        } else {
            // Escapar y mostrar los datos del objeto meteorito seleccionado
            $nombre = htmlspecialchars($meteorito_seleccionado->getName());
            $tamano = htmlspecialchars($meteorito_seleccionado->getTamano());
            $fechaAprox = htmlspecialchars($meteorito_seleccionado->getCloseApproachDate());
            $velocidad = htmlspecialchars($meteorito_seleccionado->getVelocidad());

            echo <<<HTML
            <ul>
                <li>
                    <strong>Nombre:</strong> {$nombre}<br>
                    <strong>Diámetro:</strong> {$tamano}<br>
                    <strong>Fecha de aproximación:</strong> {$fechaAprox}<br>
                </li>
            </ul>
            <a href="index.php?action=calcular&tam={$tamano}&velocidad={$velocidad}">Calcular energía de impacto</a><br>
HTML;
        }

        echo <<<HTML
            <a href="index.php">Volver a buscar</a>
        </body>
        </html>
        HTML;
    }
}



