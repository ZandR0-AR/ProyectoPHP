<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CajerosSeeder extends Seeder
{
    public function run()
    {
        // Datos reales de cajeros
        $cajeros = [
            [
                'provincia' => 'Pichincha',
                'ciudad' => 'Quito',
                'numero_serie' => 'AN-QT-001',
                'estado' => 'activo',
                'latitud' => -0.180653,
                'longitud' => -78.467834,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'provincia' => 'Guayas',
                'ciudad' => 'Guayaquil',
                'numero_serie' => 'AN-GY-002',
                'estado' => 'inactivo',
                'latitud' => -2.170998,
                'longitud' => -79.922359,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'provincia' => 'Azuay',
                'ciudad' => 'Cuenca',
                'numero_serie' => 'AN-CN-003',
                'estado' => 'mantenimiento',
                'latitud' => -2.900128,
                'longitud' => -79.004531,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'provincia' => 'Manabí',
                'ciudad' => 'Manta',
                'numero_serie' => 'AN-MT-004',
                'estado' => 'activo',
                'latitud' => -0.968178,
                'longitud' => -80.707308,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'provincia' => 'Loja',
                'ciudad' => 'Loja',
                'numero_serie' => 'AN-LJ-005',
                'estado' => 'activo',
                'latitud' => -3.990181,
                'longitud' => -79.204220,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'provincia' => 'Tungurahua',
                'ciudad' => 'Ambato',
                'numero_serie' => 'AN-AB-006',
                'estado' => 'inactivo',
                'latitud' => -1.24167,
                'longitud' => -78.61974,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'provincia' => 'El Oro',
                'ciudad' => 'Machala',
                'numero_serie' => 'AN-MH-007',
                'estado' => 'mantenimiento',
                'latitud' => -3.258611,
                'longitud' => -79.963056,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insertar datos en la tabla cajeros
        $this->db->table('cajeros')->insertBatch($cajeros);
    }
}
