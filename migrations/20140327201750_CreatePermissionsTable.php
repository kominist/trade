<?php

use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class CreatePermissionsTable extends Migration {

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
		$this->schema->create('permissions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('slug', 100);
		});
	}

	public function down()
	{
		$this->schema->drop('permissions');
	}
}
