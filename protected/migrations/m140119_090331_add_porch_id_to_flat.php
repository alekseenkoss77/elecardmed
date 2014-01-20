<?php

class m140119_090331_add_porch_id_to_flat extends CDbMigration
{
	public function up()
	{
		$this->addColumn('tbl_flat', 'porch_id', 'integer');
	}

	public function down()
	{
		echo "m140119_090331_add_porch_id_to_flat does not support migration down.\n";
		return false;
	}
}