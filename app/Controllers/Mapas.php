<?php

namespace App\Controllers;

use App\Models\AgenciasModel;
use App\Models\CajerosModel;
use App\Models\CorresponsalesModel;

class Mapas extends BaseController
{
    // Método para la API que devuelve JSON con ubicaciones
    public function index()
    {
        $agenciasModel = new AgenciasModel();
        $cajerosModel = new CajerosModel();
        $corresponsalesModel = new CorresponsalesModel();

        $agencias = $agenciasModel->select('nombre, latitud, longitud')->findAll();
        $cajeros = $cajerosModel->select('numero_serie, latitud, longitud')->findAll();
        $corresponsales = $corresponsalesModel->select('nombre, latitud, longitud')->findAll();

        $datos = [];

        foreach ($agencias as $agencia) {
            $datos[] = [
                'tipo' => 'Agencia',
                'nombre' => $agencia['nombre'],
                'latitud' => $agencia['latitud'],
                'longitud' => $agencia['longitud'],
            ];
        }

        foreach ($cajeros as $cajero) {
            $datos[] = [
                'tipo' => 'Cajero',
                'numero_serie' => $cajero['numero_serie'],
                'latitud' => $cajero['latitud'],
                'longitud' => $cajero['longitud'],
            ];
        }

        foreach ($corresponsales as $corresponsal) {
            $datos[] = [
                'tipo' => 'Corresponsal',
                'nombre' => $corresponsal['nombre'],
                'latitud' => $corresponsal['latitud'],
                'longitud' => $corresponsal['longitud'],
            ];
        }

        return $this->response->setStatusCode(200)
                              ->setHeader('Content-Type', 'application/json')
                              ->setJSON($datos);
    }

    // Nuevo método para cargar la vista con el mapa
    public function vista()
    {
        $agenciasModel = new AgenciasModel();
        $cajerosModel = new CajerosModel();
        $corresponsalesModel = new CorresponsalesModel();
        
        // Obtener conteos
        $totalAgencias = $agenciasModel->countAll();
        $totalCajeros = $cajerosModel->countAll();
        $totalCorresponsales = $corresponsalesModel->countAll();
        
        // Obtener datos para el mapa (puedes reutilizar la lógica del método index si lo prefieres)
        $agencias = $agenciasModel->select('nombre, latitud, longitud')->findAll();
        $cajeros = $cajerosModel->select('numero_serie, latitud, longitud')->findAll();
        $corresponsales = $corresponsalesModel->select('nombre, latitud, longitud')->findAll();

        $data = [
            'total_agencias' => $totalAgencias,
            'total_cajeros' => $totalCajeros,
            'total_corresponsales' => $totalCorresponsales,
            'agencias' => $agencias,
            'corresponsales' => $corresponsales
        ];

        return view('mapas/vistaMapas', $data);
    }

    // Método para obtener solo los conteos (útil para AJAX)
    public function conteos()
    {
        $agenciasModel = new AgenciasModel();
        $cajerosModel = new CajerosModel();
        $corresponsalesModel = new CorresponsalesModel();
        
        return $this->response->setStatusCode(200)
                              ->setJSON([
                                  'agencias' => $agenciasModel->countAll(),
                                  'cajeros' => $cajerosModel->coutAll(),
                                  'corresponsales' => $corresponsalesModel->countAll()
                              ]);
    }

    public function show($id = null)
    {
        return $this->response->setStatusCode(404)
                              ->setJSON(['error' => 'No implementado']);
    }

    public function create()
    {
        return $this->response->setStatusCode(405)
                              ->setJSON(['error' => 'Método no permitido']);
    }

    public function update($id = null)
    {
        return $this->response->setStatusCode(405)
                              ->setJSON(['error' => 'Método no permitido']);
    }

    public function delete($id = null)
    {
        return $this->response->setStatusCode(405)
                              ->setJSON(['error' => 'Método no permitido']);
    }
}