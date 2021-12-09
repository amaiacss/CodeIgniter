<?=$cabecera;?>

<!-- FORMULARIO -->
<div class="card">
        <div class="card-body">
            <h5 class="card-title">Editar los datos del libro</h5>
            <p class="card-text">

                <!-- action: usamos este método que devuelve la url del sitio y agrega guardar, en esta caso sería algo como http://localhost:8080/guardar   -->
                <form method="post" action="<?=site_url('/actualizar')?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$libro['id'];?>">    

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" value="<?=$libro['nombre'];?>" class="form-control" type="text" name="nombre">
                    </div>
                    
                    <div class="form-group">
                        <label for="imagen">Imagen: </label>
                        <br>
                        <!-- Se muestra la imagen guardada -->
                        <img class="img-thumbnail" src="<?=base_url()?>/uploads/<?=$libro['imagen'];?>" width="100" alt="">  
                        <input id="imagen" class="form-control-file" type="file" name="imagen">
                    </div>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <!-- BOTÓN DE CANCELAR Y REGRESA A LISTAR -->
                        <a href="<?=base_url('listar');?>" class="btn btn-info">Cancelar</a>
                </form>
            </p>
        </div>
    </div>
    
<?=$piepagina;?>