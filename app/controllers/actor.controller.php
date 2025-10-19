<?php
require_once './app/views/actor.view.php';
require_once './app/views/alert.view.php';
require_once './app/models/actor.model.php';
require_once './helpers/validation.helper.php';

//controller de actores
class actorcontroller
{

    private $model;
    private $modellista;
    private $view;
    private $alertview;

    public function __construct()
    {
        //se instancian los dos modelos para no delegar mal, y que cada modelo acceda a su tabla correspondiente.
        $this->model = new actormodel();
        $this->modellista = new listamodel();
        $this->view = new actorview();
        $this->alertview = new Alertview();
    }

    //listaa completa
    public function mostrar_actor()
    {
        $actores = $this->model->obtener_actor();
        if ($actores != null) {
            $this->view->mostrar_actor($actores, AuthHelper::isAdmin());
        } else {
            $this->alertview->render_empty("no hay elementos para mostrar");
        }
    }

    //listaa filtrada
    public function mostrar_actor_por_id($id)
    {
        if (ValidationHelper::verifyIdRouter($id)) { //validacion datos recibidos del router
            $actor = $this->modellista->obtener_pelicula_actor_por_id($id);//selecciona los items relacionados y la actor asociada segun parametro
            if ($actor != null) {
                $this->view->mostrar_peliculas_actor_por_id($actor);
            } else {
                $this->alertview->render_empty("la actor seleccionada no contiene items asociados");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    //eliminar actor
    public function remover_actor($id)
    {
        AuthHelper::verify(); //verifico permisos y parametros validos
        if (ValidationHelper::verifyIdRouter($id)) {
            try {
                $actorEliminada = $this->model->eliminar_actor($id);
                if ($actorEliminada > 0) {
                    header('Location: ' . BASE_URL . "actor");
                } else {
                    $this->alertview->render_error("error al intentar eliminar");
                }
            } catch (PDOException) {
                $this->alertview->render_error("la actor que intenta eliminar, tiene asociado un conjunto de items.
                                            Para poder eliminar correctamente,
                                            debera eliminar los registros de los items asociados/
                                            ");
            }
        } else {
            $this->alertview->render_error("404-Not-Found");
        }
    }

    //mostrar formulario modificacion
    public function mostrar_formulario_actor_modificacion($id){
        AuthHelper::verify(); //verifico permisos y parametros validos
        if (ValidationHelper::verifyIdRouter($id)) {
            $actor = $this->model->obtener_actor_id($id);//consulto los datos actuales
            if($actor!=null){
            $this->view->mostrar_formulario_actor_modificacion($actor);
            }
            else{
                $this->alertview->render_error("error al intentar mostrar formulario");
            }
        }else{
            $this->alertview->render_error("404-Not-Found");
        }
    }

    //enviar datos de modificacion 
    public function mostrar_actor_modificacion(){
        AuthHelper::verify();
        try {//verifico permisos, parametros validos y posible acceso sin previo acceso al form modificacion.
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                $id_actor =htmlspecialchars($_POST['id_actor']);
                $nombre_actor =htmlspecialchars($_POST['nombre_actor']);
                $fecha_nacimiento =htmlspecialchars($_POST['fecha_nacimiento']);
                $edad =htmlspecialchars($_POST['edad']);
                $nacionalidad =htmlspecialchars($_POST['nacionalidad']);
                $id_pelicula =htmlspecialchars($_POST['id_pelicula ']);

                $actorModificada = $this->model->modificar_pelicula($id_actor, $nombre_actor , $fecha_nacimiento, $edad, $nacionalidad,$id_pelicula);
                if ($actorModificada > 0) {
                    header('Location: ' . BASE_URL . "actor");
                } else {
                    $this->alertview->render_error("No se pudo actualizar actor");
                }
            } else {
                $this->alertview->render_error("Error-El formulario no pudo ser procesado, asegurate de que hayas completado todos los campos");
            }
        } catch (PDOException $error) {
            $this->alertview->render_error("Error en la consulta a la base de datos/$error");
        }
    }


    //mostrar formulario altaactor
    public function mostrar_formulario_actor(){
        AuthHelper::verify();
        $this->view->mostrar_formulario_actor();
    }


    public function agregar_actor(){
        AuthHelper::verify();
        try {//verifico permisos, parametros validos y posible acceso sin datos al form de alta.
            if ($_POST && ValidationHelper::verifyForm($_POST)) {
                $id_actor =htmlspecialchars($_POST['id_actor']);
                $nombre_actor =htmlspecialchars($_POST['nombre_actor']);
                $fecha_nacimiento =htmlspecialchars($_POST['fecha_nacimiento']);
                $edad =htmlspecialchars($_POST['edad']);
                $nacionalidad =htmlspecialchars($_POST['nacionalidad']);
                $id_pelicula =htmlspecialchars($_POST['id_pelicula ']);

                $id = $this->model->insertar_actor($id_actor, $nombre_actor , $fecha_nacimiento, $edad, $nacionalidad,$id_pelicula);
                if ($id) {
                    header('Location: ' . BASE_URL . "actor");
                } else {
                    $this->alertview->render_error("Error al insertar la actor");
                }
            } else {
                $this->alertview->render_error("Error-El formulario no pudo ser procesado,
                                             asegurate de que hayas completado todos los campos");
            }
        } catch (PDOException $error) {
            $this->alertview->render_error("Error en la consulta a la base de datos/$error");
        }
    }
}
