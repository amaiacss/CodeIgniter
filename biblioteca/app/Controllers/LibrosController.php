<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro;
class LibrosController extends Controller{

    public function index() {

        // Esta clase viene del Modelo
        $libro = new Libro();

        // findAll(), indica que se busque toda la información y se guarda en la variable
        $datos['libros'] = $libro->orderBy('id', 'ASC')->findAll();

        // Se han creado dos plantillas comunes para todas las paginas, la cabecera y el pie de la pagina, su ruta se guarda en $datos, q ya se manda en la vista y se utilizará en la vista
        $datos['cabecera']= view('plantillas/cabecera');

        $datos['piepagina']= view('plantillas/piepagina');

        // Para pasar la informacion y ver los registros de la tabla libros, se le pasa la variable $datos a la vista y en la vista se trabaja con ellos
        return view('libros/listar', $datos);
    }

//CREAR
    public function crear() {

        $datos['cabecera']= view('plantillas/cabecera');

        $datos['piepagina']= view('plantillas/piepagina');

        return view('libros/crear', $datos);
    }

// GUARDAR
    public function guardar() {
        // crear una referencia al modelo
        $libro = new Libro();

        // VALIDACION DEL FORMULARIO
        $validacion = $this->validate([
            'nombre'=>'required|min_length[3]',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]',
            ]
            ]);
            // SI LA VALIDACION NO ES VÁLIDA...
        if(!$validacion) {
            $session=session();
            // Se muestra el mensaje de que no es válido
            $session->setFlashdata('mensaje', 'Revise la información');

            // Vuelve hacia atrás y manda los datos escritos para no perderlos, usa el método old() que está en el value de crear.php
            return redirect()->back()->withInput();
        }

        // obtiene los datos del formulario, en esta caso el que tiene el nombre name
        $nombre = $this->request->getVar('nombre');

        // validamos si se recibe la imagen
        if($imagen=$this->request->getFile('imagen')) {
            // renombrar la imagen para que no coincida con otras
            $nuevoNombre = $imagen->getRandomName();
            // guardar la imagen en esta ubicacion con su nuevo nombre, si la carpeta no existe se crea automaticamente
            $imagen->move('../public/uploads/', $nuevoNombre);
            // resto de datos del formulario que se guardaran en la BD
            $datos=[
                'nombre' =>$this->request->getVar('nombre'),
                'imagen' =>$nuevoNombre
            ];
            // inserta los datos en la BD
            $libro->insert($datos);

            }
            return $this->response->redirect(site_url('/listar'));
    }

// BORRAR
    // Recibe un número que es el id que se le manda desde LibrosController, y por defecto tendrá valor null en el caso de que no reciba nada
    public function borrar($id=null) {

        // Borrar de la BD y de la carpeta Uploads
        $libro = new Libro();

        // Consulta cuando el id coincida con el id que recibe el método y mostrar el primer elemento
        $datosLibro=$libro->where('id', $id)->first();

        $ruta=('../public/uploads/'.$datosLibro['imagen']);
        // Borrar la imagen de la ruta de la carpeta uploads
        unlink($ruta);

        //Borrar en el elmento de la BD
        $libro->where('id', $id)->delete($id);

        // cuando lo borra redirecciona a .......
        return $this->response->redirect(site_url('/listar'));        
    }

// EDITAR
    public function editar($id=null) {
        
        $libro=new Libro();
            // Realiza una consulta a la base de datos donde el id coincide con el id pasado y devuelve un dato
        $datos['libro'] =$libro->where('id', $id)->first();

        // cabecera y pie de pagina
        $datos['cabecera']= view('plantillas/cabecera');
        $datos['piepagina']= view('plantillas/piepagina');


        return view('libros/editar', $datos);
    }

// ACTUALIZAR
    public function actualizar() {
        $libro = new Libro();

        // recepcionamos los datos del formulario de editar
        $datos=[
            'nombre'=>$this->request->getVar('nombre'),
        ];

        // recogemos el id que está oculto en el fomulario
        $id = $this->request->getVar('id');

        // VALIDACION DEL NOMBRE
        $validacion = $this->validate([
            'nombre'=>'required|min_length[3]',            
        ]);
            // SI LA VALIDACION NO ES VÁLIDA...
        if(!$validacion) {
            $session=session();
            // Se muestra el mensaje de que no es válido
            $session->setFlashdata('mensaje', 'Revise la información');

            // Vuelve hacia atrás y manda los datos escritos para no perderlos, usa el método old() que está en el value de crear.php
            return redirect()->back()->withInput();
        }

        // Validacion de la imagen, en el caso de que se quiera cambiar la imagen, debe cumplir unos requisitos,el campo que se quiere validar es 'imagen', primero valida que tenga una imagen, segundo que tenga el formato que se indica y tercero el peso maximo

        $validacion = $this->validate([
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]',
            ]
            ]);

            // SI LA VALIDACION ES CORRECTA, ES TRUE
            if($validacion) {
                if($imagen=$this->request->getFile('imagen')) {

                    // obtenemos los datos de la BD del id que le pasamos
                    $datosLibro=$libro->where('id',$id)->first();
                    // guardamos la ruta de la imagen
                    $ruta=('../public/uploads/'.$datosLibro['imagen']);
                    // Borrar la imagen de la ruta de la carpeta uploads
                    unlink($ruta);
                    // renombrar la imagen para que no coincida con otras
                    $nuevoNombre = $imagen->getRandomName();
                    // guardar la imagen en esta ubicacion con su nuevo nombre, si la carpeta no existe se crea automaticamente
                    $imagen->move('../public/uploads/', $nuevoNombre);
                    //dato de la imagen que se guardaran en la BD
                    $datos=['imagen' =>$nuevoNombre];
                    // actualiza los datos en la BD
                    $libro->update($id,$datos);        
                    }
            }

        // Actualiza los datos en la BD
        $libro->update($id,$datos);

        // cuando lo actualiza redirecciona a .......
        return $this->response->redirect(site_url('/listar'));
    }

}