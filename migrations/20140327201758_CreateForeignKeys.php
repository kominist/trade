<?php

use Illuminate\Database\Schema\Blueprint;
use Phpmig\Migration\Migration;

class CreateForeignKeys extends Migration {

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
		$this->schema->table('permission_role', function(Blueprint $table) {
			$table->foreign('permission_id')->references('id')->on('permissions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		$this->schema->table('permission_role', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		$this->schema->table('role_user', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		$this->schema->table('role_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		$this->schema->table('login_attempts', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		$this->schema->table('permission_role', function(Blueprint $table) {
			$table->dropForeign('permission_role_permission_id_foreign');
		});
		$this->schema->table('permission_role', function(Blueprint $table) {
			$table->dropForeign('permission_role_role_id_foreign');
		});
		$this->schema->table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_role_id_foreign');
		});
		$this->schema->table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_user_id_foreign');
		});
		$this->schema->table('login_attempts', function(Blueprint $table) {
			$table->dropForeign('login_attempts_user_id_foreign');
		});
	}
}
