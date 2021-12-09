<?php 
namespace App\Models;

use CodeIgniter\Model;

class Libro extends Model{
    protected $table      = 'libros';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    // activar el acceso a estas columnas de la BD
    protected $allowedFields= ['nombre', 'imagen'];
}