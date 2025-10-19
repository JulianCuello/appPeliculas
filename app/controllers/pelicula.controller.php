<?php
require_once './app/models/pelicula.model.php';
require_once './app/models/actor.model.php';
require_once './app/views/pelicula.view.php';
require_once './app/views/alert.view.php';
require_once './helpers/validation.helper.php';

//controler de peliculas
class Peliculacontroller{

    private $model;
    private $view;
    private $alertview;
    private $modelactor;

    public function __construct(){
        //se instancian los dos modelos para no delegar mal, y que cada modelo consulte solo a su tabla correspondiente.
        $this->model = new listamodel();
        $this->modelactor = new actormodel();
        $this->view = new listaview();
        $this->alertview = new Alertview();
    }

    //listaa completa
    public function mostrar_pelicula(){
        $lista = $this->model->obtener_lista();
        if ($lista != null) {
            $this->view->mostrar_lista($lista, AuthHelper::isAdmin());
        } else {
            $this->alertview->render_empty("la listaa se encuetra vacia");
        }
    }

    //listaa filtrada
    public function mostrar_pelicula_por_id($id){
        if (ValidationHelper::verifyIdRouter($id)){//validacion datos recibidos del router
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

    //eliminarItem
    public function eliminar_pelicula($id){
        AuthHelper::verify(); //verifico permisos y parametros validos
        if (ValidationHelper::verifyIdRouter($id)) {
            try {
                $registroEliminado = $this->model->eliminar_pelicula($id);
                if ($registroEliminado > 0) {
                    header('Location: ' . BASE_URL . "lista");
                } else {
                    $this->alertview->render_error("error al intentar eliminar");
                }
            } catch (PDOException $error) {
                $this->alertview->render_error("Error en la consulta a la base de datos/$error");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    //mostrar formulario modificacion
    public function mostrar_formulario_modificacion($id){
        AuthHelper::verify();//verifico permisos y parametros validos
        if (ValidationHelper::verifyIdRouter($id)) {
            $item = $this->model->obtener_lista_por_id($id);//consulto los tados actuales
            if ($item != null) {
                $actor = $this->modelactor->obtener_id_actor();//consulto las actores disponibles para modificar
                $this->view->mostrar_formulario_modificacion($actor, $item);
            } else {
                $this->alertview->render_error("error al intentar mostrar formulario");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    //enviar datos de modificacion
    public function mostrar_modificacion(){
        AuthHelper::verify();
        try {//verifico permisos, parametros validos y posible acceso sin previo acceso al form modificacion.
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                    $id_pelicula = $_POST['id_pelicula'];
                    $nombre_pelicula = $_POST['nombre_pelicula'];
                    $duracion = $_POST['duracion'];
                    $genero = $_POST['genero'];
                    $descripcion = $_POST['descripcion'];
                    $fecha_estreno = $_POST['fecha_estreno'];
                    $publico = $_POST['publico'];
                    $img = $_POST['img'];
                    $id_actor = $_POST['id_actor'];
                $registroModificado = $this->model->modificar_pelicula($id_pelicula,$nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor);

                if ($registroModificado > 0) {
                    header('Location: ' . BASE_URL . "lista");
                } else {
                    $this->alertview->render_error("No se pudo actualizar registro");
                }
            } else {
                $this->alertview->render_error("error-el formulario no pudo ser procesado, asegurate de que hayas completado todos los campos");
            }
        } catch (PDOException $error) {
            $this->alertview->render_error("error en la consulta a la base de datos/$error");
        }
    }
    
    //mostrar formulario altaProducto
    public function mostrar_formulario_alta(){
        AuthHelper::verify();
        $actor = $this->modelactor->obtener_id_actor(); //consulta las actores disponibles
        $this->view->showForm($actor);
    }

    //agregar producto
    public function agregar_pelicula(){
        AuthHelper::verify();
        try {//verifico permisos, parametros validos y posible acceso sin previo acceso al form alta.
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                    $nombre_pelicula = $_POST['nombre_pelicula'];
                    $duracion = $_POST['duracion'];
                    $genero = $_POST['genero'];
                    $descripcion = $_POST['descripcion'];
                    $fecha_estreno = $_POST['fecha_estreno'];
                    $publico = $_POST['publico'];
                    $img = $_POST['img'];
                    $id_actor = $_POST['id_actor'];
                $id = $this->model->insertar_pelicula($nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor);

                if ($id) {
                    header('Location: ' . BASE_URL . "lista");
                } else {
                    $this->alertview->render_error("Error al insertar la tarea");
                }
            } else {
                $this->alertview->render_error("Error-El formulario no pudo ser procesado, asegurate de que hayas completado todos los campos");
            }
        } catch (PDOException $error) {
            $this->alertview->render_error("Error en la consulta a la base de datos/$error");
        }
    }
}
