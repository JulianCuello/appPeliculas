<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './helpers/auth.helper.php';

class Authcontroller{
    private $view;
    private $model;

    public function __construct(){
        $this->model = new Usermodel();
        $this->view = new Authview();
    }

    public function showLogin(){
        $this->view->showLogin();
    }

    public function auth(){ //autenticacion de Usuario
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->view->showLogin('Datos incompletos');
            return;
        }

        //busco al usuario en la base
        $user = $this->model->getByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            //si es valida la utenticacion se loguea y redirije.
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . "lista");
            exit();
        } else {
            //no fue autenticado.
            $this->view->showLogin('Usuario inválido'); 
        }
    }

    public function logout(){
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }

}


// $clave='admin';
// $hash= password_hash($clave,PASSWORD_BCRYPT);

