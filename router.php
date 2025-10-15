<?php
require_once './app/controlador/pelicula_controlador.php';
require_once './config.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// Instanciamos el controlador
$controlador = new PeliculaControlador();

$action = 'listar'; // Acción por defecto
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    //esto muestras las peliculas.
    case 'listar':
        $controlador->mostrar_peliculas();
        break;
        //aca lo que hace es poner en funcionamiento el boton "leer mas"
    case 'pelicula':
        if (!empty($params[1])) {
            $controlador->seleccionar_pelicula($params[1]);
        } else {
            echo "ID de película no proporcionado.";
        }
        break;
    case 'eliminar_pelicula':
            $controlador->eliminar_pelicula($params[1]);
            break;
    case 'agregarPeliculaFormulario':
        $controlador->mostrarFormularioAlta();
        break;
    case 'agregar_pelicula':
        $controlador->agregar_pelicula();
        break;
        echo "<h1>404 - Página no encontrada</h1>";
        break;
}