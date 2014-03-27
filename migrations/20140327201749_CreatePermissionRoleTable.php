<?php

use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class CreatePermissionRoleTable extends Migration {

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
		$this->schema->create('permission_role', function(Blueprint $table) {
			$table->integer('permission_id')->unsigned();
			$table->integer('role_id')->unsigned();
		});
	}

	public function down()
	{
		$this->schema->drop('permission_role');
	}
}
