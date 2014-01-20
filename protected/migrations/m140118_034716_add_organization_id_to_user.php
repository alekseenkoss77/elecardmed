<?php

class m140118_034716_add_organization_id_to_user extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_user','organization_id','integer');
	}

	public function down()
	{
		echo "m140118_034716_add_organization_id_to_user does not support migration down.\n";
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