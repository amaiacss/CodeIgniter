## INSTALACION Y USO CodeIgniter 4

// Es necesario tener instalado composer

### Crear un proyecto desde la terminal :
        composer create-project codeigniter4/appstarter project-root

        composer clearcache 

        composer update

### Configurar en app/Config/App.php -->  public $baseURL = 'http://localhost/CodeIgniter/biblioteca/public/'; 


Configurar la informacion de la BD en app/Config/Database.php  en public $default

        Lanzar el servidor --> php spark serve


En el archivo .env poner --> app.baseURL = 'http://localhost:8080/'
En el mismo archivo configurar la base de datos por defecto en 'DATABASE':
        database.default.hostname = localhost
        database.default.database = biblioteca-codeigniter
        database.default.username = root
        database.default.password = 
        database.default.DBDriver = MySQLi
        database.default.DBPrefix =


### VER ERRORES
En el archivo app/Confg/Boot/production.php
Si tiene 0, no se ven los errores, 1 se ven

        ini_set('display_errors', '1');

        
