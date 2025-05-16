<?php

namespace App\Models;

use CodeIgniter\Model;

class CajerosModel extends Model
{
    protected $table            = 'cajeros';
    protected $primaryKey       = 'id_cajero';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'provincia',
        'ciudad',
        'numero_serie',
        'estado',
        'latitud', 
        'longitud',
        'agencia_id',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Manejo de fechas
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Casting de datos
    protected array $casts = [
        'latitud' => 'float',
        'longitud' => 'float',
        'agencia_id' => 'integer',
    ];
    protected array $castHandlers = [];

    // Reglas de validación
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
