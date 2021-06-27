<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectsTable extends Migration
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
			],
			'instructor'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'subject_name'          => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
			],
			'points'          => [
				'type'           => 'INT',
				'constraint'     => 5,
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
		$this->forge->addField('CONSTRAINT FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE');
		$this->forge->addField('CONSTRAINT FOREIGN KEY (instructor) REFERENCES users(id) ON DELETE CASCADE');
		$this->forge->createTable('subjects');
	}

	public function down()
	{
		$this->forge->dropTable('subjects');
	}
}
