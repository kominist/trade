<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoginAttemptsTable extends Migration {

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
    /* @var \Illuminate\Database\Schema\Blueprint $table */
		$this->schema->create('login_attempts', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('user_id')->unsigned();
			$table->string('login_ip', 15);
			$table->timestamp('login_time');
		});
	}

	public function down()
	{
		$this->schema->drop('login_attempts');
	}
}
