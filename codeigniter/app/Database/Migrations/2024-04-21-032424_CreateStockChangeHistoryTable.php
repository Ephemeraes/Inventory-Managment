<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStockChangeHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'record_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id' => [
                'type' => 'INT',
            ],
            'specification' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'approve' => [
                'type' => 'ENUM',
                'constraint' => ['yes', 'no'],
                'default' => "no",
            ],
            'time' => [
                'type' => 'timestamp',
            ],
            'stock_change' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addKey('record_id', TRUE);
        $this->forge->addForeignKey('id', 'Account', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('specification', 'Item', 'specification', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Stock_change_history');
    }

    public function down()
    {
        $this->forge->dropTable('Stock_change_history');
    }
}
