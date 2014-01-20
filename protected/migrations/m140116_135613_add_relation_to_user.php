<?php

class m140116_135613_add_relation_to_user extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_user', 'building_id', 'integer');
		$this->addColumn('tbl_user', 'flat_id','integer');
	}

	public function down()
	{
		echo "m140116_135613_add_relation_to_user does not support migration down.\n";
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