<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agencias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_agencia' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
                'null'       => false,
            ],
            'ciudad' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'horario_atencion' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'latitud' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,8',
                'null'       => false,
            ],
            'longitud' => [
                'type'       => 'DECIMAL',
                'constraint' => '11,8',
                'null'       => false,
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id_agencia', true);
        $this->forge->createTable('agencias');
    }

    public function down()
    {
        $this->forge->dropTable('agencias');
    }
}
