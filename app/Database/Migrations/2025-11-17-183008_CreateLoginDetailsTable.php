<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoginDetailsTable extends Migration
{
     public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);
        $this->forge->addKey('id', true); // primary key
        $this->forge->createTable('login_details');
    }

    public function down()
    {
        $this->forge->dropTable('login_details');
    }
}
