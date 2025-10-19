<?php
require_once './config.php';
require_once './app/controllers/pelicula.controller.php';
require_once './app/controllers/actor.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/show.controller.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'lista'; // accion por defecto

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

/*
  tabla ruteo                controller                                          descripc                                    
| lista                   -> |peliculacontroller    |mostrar_pelicula()              |listaa productos                       |
| listaId/:id             -> |peliculacontroller    |mostrar_pelicula_por_id(id)        |listaa producto por id                 |
| eliminar_pelicula/:id         -> |peliculacontroller    |eliminar_pelicula(id)          |elimina registro de item              |
| modificar_pelicula_formulario/:id     -> |peliculacontroller    |mostrar_formulario_modificacion(id)      |redirige a formulario de modificacion |
| modificar_pelicula             -> |peliculacontroller    |mostrar_modificacion()            |envia formulario con modificacion     |
| agregar_pelicula_formulario            -> |peliculacontroller    |mostrar_formulario_alta()          |redirige a formulario alta producto   |
| agregar_pelicula                -> |peliculacontroller    |agregar_pelicula()               |envia formulario y crea nuevo producto|
|---------------------------|------------------|------------------------|--------------------------------------|
| actor               -> |actorcontroller|mostrar_actor()          |listaa actores                      |
| actorId/:id         -> |actorcontroller|mostrar_actor_por_id())     |listaa actor por id                |
| remover_actor/:id     -> |actorcontroller|remover_actor()        |elimina registro de actor         |
| modificar_actor_formulario/:id -> |actorcontroller|mostrar_formulario_actor_modificacion()|redirige a formulario de modificacion |
| modificar_actor         -> |actorcontroller|mostrar_actor_modificacion()    |envia formulario con modificacion     |
| agregar_actor_formulario        -> |actorcontroller|mostrar_formulario_actor()      |redirige a formulario alta actor  |
| agregar_actor            -> |actorcontroller|agregar_actor()           |envia formulario ,crea nueva actor|
|---------------------------|------------------|------------------------|--------------------------------------|
| login                  -> |Authcontroller    |showLogin()             |                                      |
| logout                 -> |Authcontroller    |showLogout()            |                                      |
*/

$params = explode('/', $action);

//instancio una sola vez
$peliculacontroller = new peliculacontroller();
$actorcontroller = new actorcontroller();
$authcontroller = new Authcontroller();
$mostrar_controller = new mostrar_controller();

switch ($params[0]) {

    case 'lista':
        $peliculacontroller->mostrar_pelicula();
        break;
    case 'listaId':
        if(isset($params[1]))
        $peliculacontroller->mostrar_pelicula_por_id($params[1]);
        else $peliculacontroller->mostrar_pelicula();
        break;
    case 'eliminar_pelicula':
        if(isset($params[1]))
        $peliculacontroller->eliminar_pelicula($params[1]);
        else $mostrar_controller->mostrar_error("404-Not-Found");
        break;
    case 'modificar_pelicula_formulario':
        if(isset($params[1]))
        $peliculacontroller->mostrar_formulario_modificacion($params[1]);
        else $mostrar_controller->mostrar_error("404-Not-Found");
        break;
    case 'modificar_pelicula':
        $peliculacontroller->mostrar_modificacion();
        break;
    case 'agregar_pelicula_formulario':
        $peliculacontroller->mostrar_formulario_alta();
        break;
    case 'agregar_pelicula':
        $peliculacontroller->agregar_pelicula();
        break;
    case 'actor':
        $actorcontroller->mostrar_actor();
        break;
    case 'actorId':
        if(isset($params[1]))
        $actorcontroller->mostrar_actor_por_id($params[1]);
        else $actorcontroller->mostrar_actor();
        break;
    case 'remover_actor':
        if(isset($params[1]))
        $actorcontroller->remover_actor($params[1]);
        else $mostrar_controller->mostrar_error("404-Not-Found");
        break;
    case 'modificar_actor_formulario':
        if(isset($params[1]))
        $actorcontroller->mostrar_formulario_actor_modificacion($params[1]);
        else $mostrar_controller->mostrar_error("404-Not-Found");
        break;
    case 'modificar_actor':
        $actorcontroller->mostrar_actor_modificacion();
        break;
    case 'agregar_actor_formulario':
        $actorcontroller->mostrar_formulario_actor();
        break;
    case 'agregar_actor':
        $actorcontroller->agregar_actor();
        break;
    case 'login':
        $authcontroller->showLogin();
        break;
    case 'logout':
        $authcontroller->logout();
        break;
    case 'auth':
        $authcontroller->auth();
        break;
    default:
        $mostrar_controller->mostrar_error("404-Not-Found");
        break;
}
