<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de libros</title>

    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>
<body> 
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Biblioteca</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url('listar')?>">Libros</a>
                </li>
                
            </ul>
        </div>
    </nav>   
    <div class="container">
            <!-- Para poder mostrar el mensaje de erroR en caso de que la validacion de LibrosController no sea la correcta -->
    <!-- Si hay varibles de sesión, es que hay un error  -->
    <!-- Uso validaciones en crear y editar -->
    <?php if(session('mensaje')){?>
    <div class="alert alert-danger" role="alert">
        <?php
            echo session('mensaje');
        ?>
    </div>
<?php } ?>