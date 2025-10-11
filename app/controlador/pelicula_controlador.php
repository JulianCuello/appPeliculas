<?php
require_once './app/modelo/pelicula_modelo.php';
require_once './app/vista/pelicula_vista.php';

class PeliculaControlador {
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new PeliculaModelo();
        $this->vista = new PeliculaVista();
    }

    public function mostrar_peliculas() {
        $peliculas = $this->modelo->mostrar_peliculas();
        return $this->vista->mostrar_peliculas($peliculas);
    }

    public function seleccionar_pelicula($id) {
        $pelicula = $this->modelo->seleccionar_pelicula($id);
        return $this->vista->mostrar_pelicula($pelicula);
    }
    public function eliminar_pelicula($id) {
    $this->modelo->eliminar_pelicula($id);
    header('Location: ' . BASE_URL."listar");
    exit;
}
   
}
