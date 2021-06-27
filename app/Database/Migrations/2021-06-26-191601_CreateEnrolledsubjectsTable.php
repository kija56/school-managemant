<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrolledsubjectsTable extends Migration
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
				'subject_id'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
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
				'created_date datetime default current_timestamp',
				'updated_date datetime default current_timestamp on update current_timestamp',
				'updated_at' => [
					'type' => 'varchar',
					'constraint' => 250,
					'null' => true,
					'on update' => 'NOW()',
				],
			]
		);
		$this->forge->addKey('id', true);
		$this->forge->addField('CONSTRAINT FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE');
		$this->forge->addField('CONSTRAINT FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE');
		$this->forge->addField('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE' );
		$this->forge->createTable('enrolledsubjects');
	}

	public function down()
	{
		$this->forge->dropTable('enrolledsubjects');
	}
}
