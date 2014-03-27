<?php

use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class CreateRolesTable extends Migration {

  /* @var \Illuminate\Database\Schema\Builder $schema */
  protected $schema;
  protected $tableName;

  public function init()
  {
    $this->tableName = 'users';
    $this->schema = $this->get('schema');
  }

  /**
   * Do the migration
   */
  public function up()
	{
		$this->schema->create('roles', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
		});
	}

	public function down()
	{
		$this->schema->drop('roles');
	}
}
