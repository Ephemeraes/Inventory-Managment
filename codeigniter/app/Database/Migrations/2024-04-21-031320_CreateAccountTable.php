<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAccountTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'auto_increment' => TRUE,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('Account');
    }

    public function down()
    {
        $this->forge->dropTable('Account');
    }
}
