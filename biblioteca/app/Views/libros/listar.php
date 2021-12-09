<?=$cabecera?>
<!-- base_url está configurada en App.php -->
<a class="btn btn-success" href="<?=base_url('crear')?>">Crear un Libro</a>
<br><br>
        <!-- Muestra la informacion que se le ha enviado desde LibrosController, la variable es : $datos['libros'], y se accede a 'libros' directamente  -->
    <?php # print_r($libros); ?>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- MOSTRAR LOS REGISTROS DE LA BBDD -->
                <?php foreach($libros as $libro): ?>
                <tr>
                    <td><?=$libro['id'];?></td>
                    <!-- MOSTRAR LAS IMAGENES QUE ESTAN EN LA CARPETA UPLOADS -->
                    <td>
                        <img class="img-thumbnail" src="<?=base_url()?>/uploads/<?=$libro['imagen'];?>" width="100" alt="">    
                    </td>
                    <td><?=$libro['nombre'];?></td>
                    <td>
                        <a href="<?=base_url('editar/'.$libro['id']);?>" class="btn btn-info" type="button">Editar</button>
                        <a href="<?=base_url('borrar/'.$libro['id']);?>" class="btn btn-danger" type="button">Borrar</button>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
<?=$piepagina?>
