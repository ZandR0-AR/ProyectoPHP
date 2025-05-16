<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AgenciasModel;


class Agencias extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {

        
        $agenciasModel = new AgenciasModel();
        $data['agencias'] = $agenciasModel->findAll();
        return view('agencias/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        // Implementar lógica para mostrar una agencia específica si es necesario
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('agencias/nuevo');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        // Definir reglas de validación para los campos
        $reglas = [
            'nombre' => 'required',
            'telefono' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'horario_atencion' => 'required',
            'correo' => 'required',
            'foto' => 'uploaded[foto]|is_image[foto]|max_size[foto,5120]',
            'latitud' => 'required',
            'longitud' => 'required',
        ];

        // Validar los datos de entrada
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        // Procesar la imagen
        $archivo = $this->request->getFile('foto');
        $nombreArchivoSubido = "";
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreArchivoSubido = 'agencia_' . time() . rand(100, 10000) . '.' . $archivo->getExtension();
            $archivo->move(WRITEPATH . '../public/uploads/agencias', $nombreArchivoSubido);
        }

        // Insertar datos en la base de datos
        $agenciasModel = new AgenciasModel();
        $agenciasModel->insert([
            'nombre' => trim($this->request->getPost('nombre')),
            'telefono' => $this->request->getPost('telefono'),
            'ciudad' => $this->request->getPost('ciudad'),
            'direccion' => $this->request->getPost('direccion'),
            'horario_atencion' => $this->request->getPost('horario_atencion'),
            'correo' => $this->request->getPost('correo'),
            'foto' => $nombreArchivoSubido,
            'latitud' => $this->request->getPost('latitud'),
            'longitud' => $this->request->getPost('longitud'),
        ]);

        return redirect()->to('/agencias')->with('success', 'Agencia creada exitosamente.');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to('/agencias');
        }

        $agenciasModel = new AgenciasModel();
        $data['agencia'] = $agenciasModel->find($id);

        if (!$data['agencia']) {
            return redirect()->to('/agencias')->with('error', 'Agencia no encontrada.');
        }

        return view('agencias/editar', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    // app/Controllers/Agencias.php

    public function update($id = null)
    {
        // Verificar si el método es PUT y el ID no es nulo
        if ($this->request->getMethod(true) !== 'PUT' || $id === null) {
            return redirect()->route('agencias')->with('error', 'Método no permitido o ID no especificado.');
        }
    
        // Procesar la imagen solo si se ha subido un archivo nuevo
        $archivo = $this->request->getFile('foto');
        $nombreArchivoSubido = null;
    
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreArchivoSubido = 'agencia_' . time() . rand(100, 10000) . '.' . $archivo->getExtension();
            $archivo->move(WRITEPATH . '../public/uploads/agencias', $nombreArchivoSubido);
        }
    
        // Crear instancia del modelo
        $agenciasModel = new AgenciasModel();
        
        // Obtener los datos actuales de la agencia
        $agenciaActual = $agenciasModel->find($id);
        
        // Si se subió una nueva foto, usarla; si no, conservar la foto actual
        $nombreArchivoFinal = $nombreArchivoSubido ?? $agenciaActual['foto'];
    
        // Actualizar los datos de la agencia
        $agenciasModel->update($id, [
            'nombre' => trim($this->request->getPost('nombre')),
            'telefono' => $this->request->getPost('telefono'),
            'ciudad' => $this->request->getPost('ciudad'),
            'direccion' => $this->request->getPost('direccion'),
            'horario_atencion' => $this->request->getPost('horario_atencion'),
            'correo' => $this->request->getPost('correo'),
            'foto' => $nombreArchivoFinal,
            'latitud' => $this->request->getPost('latitud'),
            'longitud' => $this->request->getPost('longitud'),
        ]);
    
        return redirect()->to('/agencias')->with('success', 'Agencia actualizada exitosamente.');
    }
    

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
{
    if (!$this->request->is('delete') || $id == null) {
        return redirect()->route('agencias');
    }

    $agenciasModel = new AgenciasModel();
    $agenciasModel->delete($id);
    return redirect()->to('agencias');
}
}


//DOCUMENTACION RAPIDA DE COMANDOS 
// COMANDO PARA LA CREACION DE CONTROLADOR php spark make:controller NombreDelControlador --restful
