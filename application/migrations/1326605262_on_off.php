<?php

class On_Off {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bundles', function($table)
		{
			$table->string('active', 1);
			$table->key('index', 'active');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bundles', function($table)
		{
			$table->drop_column('active');
			$table->drop_key('index', 'active');
		});
	}

}