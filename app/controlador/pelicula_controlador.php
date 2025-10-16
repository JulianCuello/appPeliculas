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

    public function agregar_pelicula() {
        if (!isset($_POST['nombre_pelicula']) || empty($_POST['nombre_pelicula'])) {
            return $this->vista->mostrar_error('Falta completar el nombre de la pelicula');
        }

        if (!isset($_POST['duracion']) || empty($_POST['duracion'])) {
            return $this->vista->mostrar_error('Falta completar la duracion');
        }
        if (!isset($_POST['genero']) || empty($_POST['genero'])) {
            return $this->vista->mostrar_error('Falta completar el genero');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->vista->mostrar_error('Falta completar la descripcion');
        }
        if (!isset($_POST['fecha_estreno']) || empty($_POST['fecha_estreno'])) {
            return $this->vista->mostrar_error('Falta completar fecha de estreno');
        }
        if (!isset($_POST['publico']) || empty($_POST['publico'])) {
            return $this->vista->mostrar_error('Falta completar el publico');
        }
        if (!isset($_POST['img']) || empty($_POST['img'])) {
            return $this->vista->mostrar_error('Falta completar la img');
        }

        $nombre_pelicula = $_POST['nombre_pelicula'];
        $duracion = $_POST['duracion'];
        $genero = $_POST['genero'];
        $descripcion = $_POST['descripcion'];
        $fecha_estreno = $_POST['fecha_estreno'];
        $publico = $_POST['publico'];
        $img = $_POST['img'];
        $id_actor = $_POST['id_actor'];

        $id = $this->modelo->insertar_pelicula($nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor);

        // redirijo al home (también podriamos usar un método de una vista para motrar un mensaje de éxito)
        header('Location: ' . BASE_URL . 'lista');
    }

   public function mostrar_formulario_alta(){
        $actor = $this->peliculaModelo->obtener_id_actor(); //consulta las categorias disponibles
        $this->vista->mostrarFormulario($actor);
 }
}
