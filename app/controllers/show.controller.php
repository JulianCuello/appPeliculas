<?php
require_once './app/views/pelicula.view.php';

//controller de manejo de errores que utiliza el router, por default y parametros no definidos $params[1]
class mostrar_controller{

    private $view;

    public function __construct(){
        $this->view = new Alertview();
    }

    public function mostrar_error($error){
        $this->view->render_error($error);
    }
}
