<?php 
//view de autenticacion
class Authview {
    
    public function showLogin($error = null) {
        require './templates/auth/login.phtml';
    } 
}
