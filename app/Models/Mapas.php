<?php

namespace App\Models;

use CodeIgniter\Model;

class Mapas extends Model
{
    protected $table            = 'mapas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Función para consultar todas las agencias
    public function consultarAgencias()
    {
        $query = $this->db->table('agencias')->select('nombre, latitud, longitud')->get();
        return $query->getResult();
    }

    // Función para consultar todos los cajeros
    public function consultarCajeros()
    {
        $query = $this->db->table('cajeros')->select('nombre, latitud, longitud')->get();
        return $query->getResult();
    }

    // Función para consultar todos los corresponsales
    public function consultarCorresponsales()
    {
        $query = $this->db->table('corresponsales')->select('nombre, latitud, longitud')->get();
        return $query->getResult();
    }
}
