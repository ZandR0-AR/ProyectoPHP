<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Corresponsales extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_corresponsal' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => false,
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
            'comision' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'agencia_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
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
        $this->forge->addKey('id_corresponsal', true);

        // Clave foránea para relacionar con "agencias"
        $this->forge->addForeignKey('agencia_id', 'agencias', 'id_agencia', 'CASCADE', 'CASCADE');

        // Crear la tabla
        $this->forge->createTable('corresponsales');
    }

    public function down()
    {
        $this->forge->dropTable('corresponsales');
    }
}
