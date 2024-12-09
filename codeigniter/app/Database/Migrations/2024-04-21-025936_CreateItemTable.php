<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'specification' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'place' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['screw', 'pipe', 'iron core', 'copper wire'],
            ],
            'stock_number' => [
                'type' => 'INT',
            ],
        ]);
        
        $this->forge->addKey('specification', TRUE); 
        $this->forge->createTable('Item'); 
    }

    public function down()
    {
        $this->forge->dropTable('Item');
    }
}
