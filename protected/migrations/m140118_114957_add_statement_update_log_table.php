<?php

class m140118_114957_add_statement_update_log_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('tbl_statement_log', array(
			'id' => 'pk',
			'counter_id' => 'integer',
			'value' => 'integer',
			'date_change' => 'date',
			'person' => 'string'
		));
	}

	public function down()
	{
		echo "m140118_114957_add_statement_update_log_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}