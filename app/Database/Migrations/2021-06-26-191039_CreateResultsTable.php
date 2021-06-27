<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResultsTable extends Migration
{
	public function up()
	{
		$this->forge->addField(
			[
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
			'user_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'subject_id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'score'       => [
				'type'       => 'VARCHAR',
				'constraint' => '100',
			],
			'status'       => [
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
		$this->forge->addField('CONSTRAINT FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE');
		$this->forge->addField('CONSTRAINT FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE' );
		$this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
		$this->forge->createTable('results');
	}

	public function down()
	{
		$this->forge->dropTable('results');
	}
}
