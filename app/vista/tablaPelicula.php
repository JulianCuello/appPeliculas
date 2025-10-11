<?php
require 'templates/header.php';   
?>
        <table class="table">
            <thead>
                <tr>
                    <th>id_pelicula</th>
                    <th>nombreProducto</th>
                    <th>duracion</th>
                    <th>genero</th>
                    <th>descripcion</th>
                    <th>fecha_estreno</th>
                    <th>publico</th>
                    <th>img</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pelicula as $item) { ?>      
                    <tr>
                        <td><?php echo $item->id_pelicula; ?></td>
                        <td><?php echo $item->nombre_pelicula; ?></td>
                        <td><?php echo $item->duracion; ?></td>
                        <td><?php echo $item->genero; ?></td>
                        <td><?php echo $item->descripcion; ?></td>
                        <td><?php echo $item->fecha_estreno; ?></td>
                        <td><?php echo $item->publico; ?></td>
                        <td><img src="<?php echo $item->img; ?>"class="imagen"></td>
                        <td><?php echo $item->pelicula; ?></td>
                        <td>
                            <a href="listaId/<?php echo $item->id_pelicula; ?>" class="btn btn-primary">Ver Producto</a>
                            <a href="eliminar_pelicula/<?php echo $item->id_pelicula; ?>" type="button" class='btn btn-danger ml-auto'>Eliminar</a>
                            <a href="actualizar_Pelicula/<?php echo $item->id_pelicula; ?>" type="button" class='btn btn-success ml-auto'>Modificar</a>
                        </td>
                        </tr>      
                <?php } ?>
            </tbody>
        </table>
        <?php
        require './templates/footer.php;