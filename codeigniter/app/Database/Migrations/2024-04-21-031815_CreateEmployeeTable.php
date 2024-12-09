<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployeeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['manager', 'stock clerk'],
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id', 'Account', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Employee');
    }

    public function down()
    {
        $this->forge->dropTable('Employee');
    }
}
