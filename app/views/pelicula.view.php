<?php

//view de productos
class listaview {

    public function mostrar_lista($lista,$adm) {
        require('./templates/show/lista.peliculas.phtml');        
    }
    
    public function mostrar_peliculas_lista_por_id($lista) {
        require './templates/show/lista.pelicula_por_id.phtml';   
    }

    public function mostrar_formulario_modificacion($actor, $item) {
        require './templates/forms/modificar.phtml';          
    }
    public function showForm($actor){
        require './templates/forms/nuevo.pelicula.phtml';
    }
}

    
