<?php
require_once './app/models/pelicula.model.php';
require_once './app/models/actor.model.php';
require_once './app/views/pelicula.view.php';
require_once './app/views/alert.view.php';
require_once './helpers/validation.helper.php';

class Peliculacontroller{

    private $model;
    private $view;
    private $alertview;
    private $modelactor;

    public function __construct(){
        $this->model = new listamodel();
        $this->modelactor = new actormodel();
        $this->view = new listaview();
        $this->alertview = new Alertview();
    }

    public function mostrar_pelicula(){
        $lista = $this->model->obtener_lista();
        if ($lista != null) {
            $this->view->mostrar_lista($lista, AuthHelper::isAdmin());
        } else {
            $this->alertview->render_empty("la lista se encuentra vacía");
        }
    }

    public function mostrar_pelicula_por_id($id){
        if (ValidationHelper::verifyIdRouter($id)){
            $item = $this->model->obtener_lista_por_id($id);
            if ($item != null) {
                $this->view->mostrar_peliculas_lista_por_id($item);
            } else {
                $this->alertview->render_empty("no hay elementos para mostrar");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    public function eliminar_pelicula($id){
        AuthHelper::verify();
        if (ValidationHelper::verifyIdRouter($id)) {
            try {
                $registroEliminado = $this->model->eliminar_pelicula($id);
                if ($registroEliminado > 0) {
                    header('Location: ' . BASE_URL . "lista");
                } else {
                    $this->alertview->render_error("error al intentar eliminar");
                }
            } catch (PDOException $error) {
                $this->alertview->render_error("Error: La película tiene actores asociados. Elimine primero los actores.");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    public function mostrar_formulario_modificacion($id){
        AuthHelper::verify();
        if (ValidationHelper::verifyIdRouter($id)) {
            $item = $this->model->obtener_lista_por_id($id);
            if ($item != null) {
                $this->view->mostrar_formulario_modificacion($item);
            } else {
                $this->alertview->render_error("error al intentar mostrar formulario");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    public function mostrar_modificacion(){
        AuthHelper::verify();
        try {
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                $id_pelicula = $_POST['id_pelicula'];
                $nombre_pelicula = $_POST['nombre_pelicula'];
                $duracion = $_POST['duracion'];
                $genero = $_POST['genero'];
                $descripcion = $_POST['descripcion'];
                $fecha_estreno = $_POST['fecha_estreno'];
                $publico = $_POST['publico'];
                $img = $_POST['img'];
                
                $registroModificado = $this->model->modificar_pelicula($id_pelicula, $nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img);

                if ($registroModificado > 0) {
                    header('Location: ' . BASE_URL . "lista");
                } else {
                    $this->alertview->render_error("No se pudo actualizar registro");
                }
            } else {
                $this->alertview->render_error("error-el formulario no pudo ser procesado");
            }
        } catch (PDOException $error) {
            $this->alertview->render_error("error en la consulta a la base de datos/$error");
        }
    }
    
    public function mostrar_formulario_alta(){
        AuthHelper::verify();
        $this->view->showForm();
    }

    public function agregar_pelicula(){
        AuthHelper::verify();
        try {
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                $id_pelicula = $_POST['id_pelicula'];
                $nombre_pelicula = $_POST['nombre_pelicula'];
                $duracion = $_POST['duracion'];
                $genero = $_POST['genero'];
                $descripcion = $_POST['descripcion'];
                $fecha_estreno = $_POST['fecha_estreno'];
                $publico = $_POST['publico'];
                $img = $_POST['img'];
                
                $id = $this->model->insertar_pelicula($id_pelicula, $nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img);

                if ($id) {
                    header('Location: ' . BASE_URL . "lista");
                } else {
                    $this->alertview->render_error("Error al insertar la película");
                }
            } else {
                $this->alertview->render_error("Error-El formulario no pudo ser procesado");
            }
        } catch (PDOException $error) {
            $this->alertview->render_error("Error en la consulta a la base de datos/$error");
        }
    }
}