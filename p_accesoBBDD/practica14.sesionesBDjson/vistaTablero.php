<?php
class VistaTablero
{
    public function __construc() {}
    public function mostrarTablero($pos, $meta, $score/*$traps*/)
    {
        // Mostrar el tablero de 10x10 y los controles de movimiento
        echo "<h2>Juego: Mueve el personaje para llegar a la salida</h2>";
        echo "<h3>Puntuación: {$score}</h3>";
        echo "<table border='1' cellpadding='10'>";
        for ($i = 0; $i < 10; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 10; $j++) {
                $position = $pos; // Posición del personaje
                $exit = $meta; // Posición de la salida, suponiendo que está definida en la sesión
                if ($i == $position['row'] && $j == $position['col']) {
                    // Mostrar el personaje
                    echo "<td style='background-color: green; color: white;'>P</td>";
                } elseif ($i == $exit['row'] && $j == $exit['col']) {
                    // Mostrar la salida
                    echo "<td style='background-color: yellow; color: black;'>E</td>"; // E para "Exit"
                }/*else if(count($_SESSION['moves'])==4 && $i==$traps[]){
                    $traps[]
                } */else {
                    echo "<td></td>"; // Casilla vacía
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        // Controles de movimiento
        echo "<div>";
        echo "<a href='controladorJuego.php?move=up'>Arriba</a> | ";
        echo "<a href='controladorJuego.php?move=down'>Abajo</a> | ";
        echo "<a href='controladorJuego.php?move=left'>Izquierda</a> |";
        echo "<a href='controladorJuego.php?move=right'>Derecha</a>";
        echo "</br>";
        echo "<a href='controladorJuego.php?move=exit'>Salir</a>";
        echo "<a href='verPartidasGuardadas.php'>Ver puntuaciones de partidas guardadas</a>";
        echo "</div>";
    }
    public function mostrarPartidas($arrayPartidas) {
 
        foreach($arrayPartidas as $partida){
            
            
            echo "Jugador: ".$partida['id_session'].", puntuación: ".$partida['score'].", fecha: ".$partida['date_session']."<br>";
        }
    }
    public function mostrarBombas() {
        
    }
}
