<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

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
		$this->schema->create('users', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('username', 30);
			$table->string('email', 100);
			$table->string('password', 100);
			$table->string('salt', 30);
			$table->string('register_ip', 15);
			$table->string('forget_token', 100)->nullable();
			$table->string('active_token', 100)->nullable();
		});
	}

	public function down()
	{
		$this->schema->drop('users');
	}
}
