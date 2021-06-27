<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'class_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'null'           => true,
			],
			'email'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'first_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'last_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'gender'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
				'null'           => true,
			],
			'role_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'phone_number'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],

			'password'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'created_date datetime default current_timestamp',
			'updated_date datetime default current_timestamp on update current_timestamp',
			'updated_at' => [
				'type' => 'varchar',
				'constraint' => 250,
				'null' => true,
				'on update' => 'NOW()',
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addField('CONSTRAINT FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE' );
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
