<?php

namespace App\Controllers;

use App\Models\AgenciasModel;
use App\Models\CorresponsalesModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Corresponsales extends BaseController
{
    public function index()
{
    $corresponsalesModel = new CorresponsalesModel();
    $agenciasModel = new AgenciasModel();

    // Obtener todos los corresponsales con los nombres de las agencias
    $corresponsales = $corresponsalesModel->findAll();
    foreach ($corresponsales as &$corresponsal) {
        $agencia = $agenciasModel->find($corresponsal['agencia_id']);
        $corresponsal['nombre_agencia'] = $agencia ? $agencia['nombre'] : 'Sin Agencia';
    }

    $data['corresponsales'] = $corresponsales;
    return view('corresponsales/index', $data);
}

    public function new()
    {
        $agenciasModel = new AgenciasModel();
        $data['agencias'] = $agenciasModel->findAll();
        return view('corresponsales/nuevo', $data);
    }

    public function create()
    {
        $reglas = [
            'nombre' => 'required',
            'direccion' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
            'comision' => 'required',
            'foto' => 'uploaded[foto]|is_image[foto]|max_size[foto,5120]',
            'agencia_id' => 'required|is_not_unique[agencias.id_agencia]',
            'latitud' => 'required',
            'longitud' => 'required',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        // Procesar la imagen
        $archivo = $this->request->getFile('foto');
        $nombreArchivoSubido = '';
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreArchivoSubido = 'corresponsal_' . time() . rand(100, 10000) . '.' . $archivo->getExtension();
            $archivo->move(WRITEPATH . '../public/uploads/corresponsales', $nombreArchivoSubido);
        }

        // Insertar datos en la base de datos
        $corresponsalesModel = new CorresponsalesModel();
        $corresponsalesModel->insert([
            'nombre' => trim($this->request->getPost('nombre')),
            'direccion' => trim($this->request->getPost('direccion')),
            'provincia' => trim($this->request->getPost('provincia')),
            'ciudad' => trim($this->request->getPost('ciudad')),
            'comision' => trim($this->request->getPost('comision')),
            'foto' => $nombreArchivoSubido,
            'agencia_id' => $this->request->getPost('agencia_id'),
            'latitud' => trim($this->request->getPost('latitud')),
            'longitud' => trim($this->request->getPost('longitud')),
        ]);

        return redirect()->to('/corresponsales')->with('success', 'Corresponsal creado exitosamente.');
    }

    public function edit($id = null)
    {
        if ($id === null) {
            return redirect()->to('/corresponsales');
        }

        $corresponsalesModel = new CorresponsalesModel();
        $data['corresponsal'] = $corresponsalesModel->find($id);

        if (!$data['corresponsal']) {
            return redirect()->to('/corresponsales')->with('error', 'Corresponsal no encontrado.');
        }

        $agenciasModel = new AgenciasModel();
        $data['agencias'] = $agenciasModel->findAll();

        return view('corresponsales/editar', $data);
    }

    public function update($id = null)
    {
        if ($id === null) {
            return redirect()->route('corresponsales')->with('error', 'ID no especificado.');
        }

        $reglas = [
            'nombre' => 'required',
            'direccion' => 'required',
            'provincia' => 'required',
            'ciudad' => 'required',
            'comision' => 'required',
            'agencia_id' => 'required|is_not_unique[agencias.id_agencia]',
            'latitud' => 'required',
            'longitud' => 'required',
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $archivo = $this->request->getFile('foto');
        $nombreArchivoSubido = null;

        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreArchivoSubido = 'corresponsal_' . time() . rand(100, 10000) . '.' . $archivo->getExtension();
            $archivo->move(WRITEPATH . '../public/uploads/corresponsales', $nombreArchivoSubido);
        }

        $corresponsalesModel = new CorresponsalesModel();
        $corresponsalActual = $corresponsalesModel->find($id);

        $nombreArchivoFinal = $nombreArchivoSubido ?? $corresponsalActual['foto'];

        $corresponsalesModel->update($id, [
            'nombre' => trim($this->request->getPost('nombre')),
            'direccion' => trim($this->request->getPost('direccion')),
            'provincia' => trim($this->request->getPost('provincia')),
            'ciudad' => trim($this->request->getPost('ciudad')),
            'comision' => trim($this->request->getPost('comision')),
            'foto' => $nombreArchivoFinal,
            'agencia_id' => $this->request->getPost('agencia_id'),
            'latitud' => trim($this->request->getPost('latitud')),
            'longitud' => trim($this->request->getPost('longitud')),
        ]);

        return redirect()->to('/corresponsales')->with('success', 'Corresponsal actualizado exitosamente.');
    }

    public function delete($id = null)
    {
        if ($id === null) {
            return redirect()->route('corresponsales');
        }

        $corresponsalesModel = new CorresponsalesModel();
        $corresponsalesModel->delete($id);

        return redirect()->to('/corresponsales')->with('success', 'Corresponsal eliminado exitosamente.');
    }
}
