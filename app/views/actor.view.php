<?php
    //view de actores
class actorview{

    public function mostrar_actor($actores,$adm){
        require './templates/show/lista.actor.phtml';
    }

    public function mostrar_peliculas_actor_por_id($peliculas){  // ← Cambié $actor por $peliculas
    require './templates/show/lista.actor_por_id.phtml';
    }
    
    public function mostrar_formulario_actor_modificacion($actor){
        require './templates/forms/modificar.actor.phtml';
    }
    
    public function mostrar_formulario_actor(){
        require './templates/forms/nuevo.actor.phtml';
    }

}

 


    