<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassesTable extends Migration
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
			'class_name'       => [
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
		$this->forge->createTable('classes');
	}

	public function down()
	{
		$this->forge->dropTable('classes');
	}
}
