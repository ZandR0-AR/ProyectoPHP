<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cajeros extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cajero' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'provincia' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'ciudad' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'numero_serie' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'unique'     => true,
            ],
            'estado' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
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
            'agencia_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
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

        // Clave primaria
        $this->forge->addKey('id_cajero', true);

        // Clave foránea para relacionar con "agencias"
        $this->forge->addForeignKey('agencia_id', 'agencias', 'id_agencia', 'CASCADE', 'CASCADE');

        // Crear la tabla
        $this->forge->createTable('cajeros');
    }

    public function down()
    {
        $this->forge->dropTable('cajeros');
    }
}
