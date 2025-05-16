<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AgenciasModel;
use App\Models\CajerosModel;

class Cajeros extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     */
        public function index()
{
    $cajerosModel = new CajerosModel();
    $agenciasModel = new AgenciasModel();

    // Obtener todos los cajeros con los nombres de las agencias
    $cajeros = $cajerosModel->findAll();
    foreach ($cajeros as &$cajero) {
        $agencia = $agenciasModel->find($cajero['agencia_id']);
        $cajero['nombre_agencia'] = $agencia ? $agencia['nombre'] : 'Sin Agencia';
    }

    $data['cajeros'] = $cajeros;
    return view('cajeros/index', $data);
}

    /**
     * Return a new resource object, with default properties.
     *
     * 
     */
    public function new()
    {
        $agenciasModel = new AgenciasModel();
        $data['agencias'] = $agenciasModel->findAll();
        return view('cajeros/nuevo', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * 
     */
    public function create()
    {
        $reglas = [
            'provincia' => 'required',
            'ciudad' => 'required',
            'numero_serie' => 'required',
            'estado' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'agencia_id' => 'required|is_not_unique[agencias.id_agencia]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $cajerosModel = new CajerosModel();
        $cajerosModel->insert([
            'provincia' => trim($this->request->getPost('provincia')),
            'ciudad' => trim($this->request->getPost('ciudad')),
            'numero_serie' => trim($this->request->getPost('numero_serie')),
            'estado' => trim($this->request->getPost('estado')),
            'latitud' => trim($this->request->getPost('latitud')),
            'longitud' => trim($this->request->getPost('longitud')),
            'agencia_id' => $this->request->getPost('agencia_id'),
        ]);

        return redirect()->to('/cajeros')->with('success', 'Cajero creado exitosamente.');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * 
     *
     * @
     */
    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to('/cajeros')->with('error', 'ID no especificado.');
        }

        $cajerosModel = new CajerosModel();
        $data['cajero'] = $cajerosModel->find($id);

        if (!$data['cajero']) {
            return redirect()->to('/cajeros')->with('error', 'Cajero no encontrado.');
        }

        $agenciasModel = new AgenciasModel();
        $data['agencias'] = $agenciasModel->findAll();

        return view('cajeros/editar', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        if ($id === null || $this->request->getMethod(true) !== 'PUT') {
            return redirect()->route('cajeros')->with('error', 'Método no permitido o ID no especificado.');
        }


        
        $reglas = [
            'provincia' => 'required',
            'ciudad' => 'required',
            'numero_serie' => 'required',
            'estado' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'agencia_id' => 'required|is_not_unique[agencias.id_agencia]',

        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }


        $cajerosModel = new CajerosModel();

        $cajerosModel->update($id, [
            'provincia' => trim($this->request->getPost('provincia')),
            'ciudad' => $this->request->getPost('ciudad'),
            'numero_serie' => $this->request->getPost('numero_serie'),
            'estado' => $this->request->getPost('estado'),
            'latitud' => $this->request->getPost('latitud'),
            'longitud' => $this->request->getPost('longitud'),
            'agencia_id' => $this->request->getPost('agencia_id'),
        ]);

        return redirect()->to('/cajeros')->with('success', 'Cajero actualizado exitosamente.');
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
        if ($id === null || !$this->request->is('delete')) {
            return redirect()->route('cajeros');
        }

        $cajerosModel = new CajerosModel();
        $cajerosModel->delete($id);
        return redirect()->to('/cajeros')->with('success', 'Cajero eliminado exitosamente.');
    }
}
