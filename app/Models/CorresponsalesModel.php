<?php

namespace App\Models;

use CodeIgniter\Model;

class CorresponsalesModel extends Model
{
    protected $table            = 'corresponsales';
    protected $primaryKey       = 'id_corresponsal';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre',
        'direccion',
        'provincia',
        'ciudad',
        'comision',
        'foto',
        'agencia_id',
        'latitud',
        'longitud',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Casting de datos para definir los tipos de datos 
    protected array $casts = [
        'comision' => 'float',
        'latitud' => 'float',
        'longitud' => 'float',
        'agencia_id' => 'integer',
    ];
    protected array $castHandlers = [];

    // Manejo de fechas con el formato 
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Reglas de validación para la entrada de los datos y ser mas seguro y eficiente el ingreso de los datos 
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
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
