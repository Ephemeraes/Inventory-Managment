<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePlaceChangeHistoryTable extends Migration
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
            'old_position' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'new_position' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('record_id', TRUE);
        $this->forge->addForeignKey('id', 'Account', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('specification', 'Item', 'specification', 'CASCADE', 'CASCADE');
        $this->forge->createTable('Place_change_history');
    }

    public function down()
    {
        $this->forge->dropTable('Place_change_history');
    }
}
