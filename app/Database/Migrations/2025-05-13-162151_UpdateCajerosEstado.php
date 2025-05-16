<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateCajerosEstado extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('cajeros', [
            'estado' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('cajeros', [
            'estado' => [
                'type'       => 'ENUM',
                'constraint' => ['activo', 'inactivo', 'mantenimiento'],
                'default'    => 'activo',
                'null'       => false,
            ],
        ]);
    }
}
