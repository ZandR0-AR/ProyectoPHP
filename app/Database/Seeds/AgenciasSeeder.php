<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AgenciasSeeder extends Seeder
{
    public function run()
    {
        // Datos reales de agencias (esto puede ser reemplazado por un archivo CSV o API para obtener datos reales)
        //  php spark make:seeder AgenciasSeeder // CREAR MI ARCHIVO SEEDS 
        // php spark db:seed AgenciasSeeder   // EJECUTAR EL INGRESO DE DATOS
        $agencias = [
            [
                'nombre' => 'Agencia Nacional',
                'telefono' => '0998765432',
                'ciudad' => 'Quito',
                'direccion' => 'Av. Amazonas N26-233, Quito, Ecuador',
                'horario_atencion' => '09:00 - 18:00',
                'correo' => 'info@agencianacional.com',
                'foto' => 'default.jpg',  // Imagen por defecto
                'latitud' => -0.1807,
                'longitud' => -78.4678,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Agencia Global',
                'telefono' => '0987654321',
                'ciudad' => 'Guayaquil',
                'direccion' => 'Calle 9 de Octubre y Chimborazo, Guayaquil, Ecuador',
                'horario_atencion' => '08:00 - 17:00',
                'correo' => 'contacto@agenciaglobal.com',
                'foto' => 'default.jpg',
                'latitud' => -2.1700,
                'longitud' => -79.9223,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Agencia Express',
                'telefono' => '0991234567',
                'ciudad' => 'Cuenca',
                'direccion' => 'Av. Don Bosco 123, Cuenca, Ecuador',
                'horario_atencion' => '10:00 - 19:00',
                'correo' => 'ventas@agenciaexpress.com',
                'foto' => 'default.jpg',
                'latitud' => -2.9006,
                'longitud' => -79.0070,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Agencia Andina',
                'telefono' => '0981234567',
                'ciudad' => 'Loja',
                'direccion' => 'Calle Bolívar 567, Loja, Ecuador',
                'horario_atencion' => '09:00 - 18:00',
                'correo' => 'soporte@agenciaandina.com',
                'foto' => 'default.jpg',
                'latitud' => -4.0041,
                'longitud' => -79.2041,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nombre' => 'Agencia Sierra',
                'telefono' => '0986543210',
                'ciudad' => 'Ambato',
                'direccion' => 'Av. Cevallos 321, Ambato, Ecuador',
                'horario_atencion' => '08:30 - 17:30',
                'correo' => 'atencion@agenciasierra.com',
                'foto' => 'default.jpg',
                'latitud' => -1.2484,
                'longitud' => -78.6163,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];
        

        // Insertar datos en la base de datos
        $this->db->table('agencias')->insertBatch($agencias);
    }
}
