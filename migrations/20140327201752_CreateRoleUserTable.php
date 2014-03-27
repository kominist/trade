<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleUserTable extends Migration {

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
		$this->schema->create('role_user', function(Blueprint $table) {
			$table->integer('role_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();
		});
	}

	public function down()
	{
		$this->schema->drop('role_user');
	}
}
