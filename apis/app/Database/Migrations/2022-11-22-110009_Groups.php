<?php

namespace App\Database\Migrations\APIv1;

use CodeIgniter\Database\Migration;

class Groups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'created_at datetime default current_timestamp',
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'      => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'      => true,
            ],
            
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('groups');
    }

    public function down()
    {
        $this->forge->dropTable('groups');
    }
}
