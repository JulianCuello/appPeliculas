<?php

class listaview {

    public function mostrar_lista($lista, $adm) {
        require('./templates/show/lista.peliculas.phtml');        
    }
    
    public function mostrar_peliculas_lista_por_id($lista) {
        require './templates/show/lista.pelicula_por_id.phtml';   
    }

    public function mostrar_formulario_modificacion($actor, $item) { // Agregar $actor
    require './templates/forms/modificar.pelicula.phtml';          
}
    
    public function showForm(){
        require './templates/forms/nueva.pelicula.phtml';
    }
}

    
