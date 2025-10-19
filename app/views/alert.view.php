<?php
//la utilizan todos los controllers para renderizar todos los mensajes o erorres.
class Alertview{

    public function render_error($error){
        require './templates/alerts/error.phtml';
    }

    public function render_empty($text){
        require './templates/alerts/empty.phtml';
    }
}
