<?php


    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;
    
    class CreateUsersTable extends Migration
    {
        public function up()
        {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'full_name' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'phone' => [
                    'type' => 'VARCHAR',
                    'constraint' => '20',
                ],
                'email' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'unique' => true,
                ],
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'unique' => true,
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                ],
                'skin' => [
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                    'default' => 'default',
                ],
                'level' => [
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                ],
                'registered_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'photo' => [
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
    
            $this->forge->addKey('id', true);
            $this->forge->createTable('users');
        }
    
        public function down()
        {
            $this->forge->dropTable('users');
        }
    }
    