const express = require("express");
const cors = require("cors");
const fs = require("fs");
const Papa = require("papaparse");

const app = express();
const PORT = 3000;
const CSV_PATH = "./peliculas.csv";

app.use(cors());

let todasLasPeliculas = []; // Todas las películas del CSV
let peliculasDisponibles = []; // Películas disponibles en la API
const INCREMENTO_PELICULAS = 2;

// 📌 Función para cargar las películas desde el archivo CSV
function cargarPeliculasDesdeCSV() {
    try {
        const data = fs.readFileSync(CSV_PATH, "utf8");
        const resultado = Papa.parse(data, { header: true });

        if (resultado.errors.length > 0) {
            console.error("❌ Error al parsear CSV:", resultado.errors);
        }

        todasLasPeliculas = resultado.data.map((peli, index) => ({
            id: index + 1,
            titulo: peli.Titulo,
            imagen: peli.Imagen,
            sinopsis: peli.Sinopsis,
        }));

        console.log(`📥 Cargadas ${todasLasPeliculas.length} películas desde el CSV.`);
    } catch (error) {
        console.error("❌ Error al leer el archivo CSV:", error);
    }
}

// 📌 Función para agregar más películas cada 10 minutos
function actualizarCatalogo() {
    if (todasLasPeliculas.length > peliculasDisponibles.length) {
        const nuevasPeliculas = todasLasPeliculas.slice(
            peliculasDisponibles.length,
            peliculasDisponibles.length + INCREMENTO_PELICULAS
        );

        peliculasDisponibles.push(...nuevasPeliculas);
        console.log(`📢 Se agregaron ${nuevasPeliculas.length} nuevas películas.`);
    } else {
        console.log("✅ No hay más películas para agregar.");
    }
}

// 📌 Inicializa el catálogo con 3 películas
cargarPeliculasDesdeCSV();
setTimeout(() => actualizarCatalogo(), 1000); // Agregar las primeras 3 al inicio
setInterval(() => actualizarCatalogo(), 10 * 60 * 1000); // Cada 10 min

// 📌 Ruta para obtener el número total de películas disponibles
app.get("/numeroPelis", (req, res) => {
    res.json({ cantidad: peliculasDisponibles.length });
});

// 📌 Ruta para obtener una película específica con retardo y errores simulados
app.get("/peli:id", (req, res) => {
    const id = parseInt(req.params.id, 10);

    if (id < 1 || id > peliculasDisponibles.length) {
        return res.status(404).json({ error: "❌ Película no encontrada." });
    }

    // Simula un error en el 20% de las peticiones
    if (Math.random() < 0.2) {
        return res.status(500).json({ error: "❌ Error del servidor al obtener la película." });
    }

    const retardo = Math.random() < 0.5 ? 1000 : 5000; // Retardo de 1 o 5 segundos

    setTimeout(() => {
        res.json({
            id: peliculasDisponibles[id - 1].id,
            titulo: peliculasDisponibles[id - 1].titulo,
            imagen: peliculasDisponibles[id - 1].imagen,
            sinopsis: peliculasDisponibles[id - 1].sinopsis,
        });
    }, retardo);
});

// 📌 Iniciar el servidor
app.listen(PORT, () => {
    console.log(`🎬 Servidor de películas corriendo en http://localhost:${PORT}`);
});
