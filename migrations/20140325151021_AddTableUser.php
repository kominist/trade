<?php

use Phpmig\Migration\Migration;

class AddTableUser extends Migration
{
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
    $this->schema->create($this->tableName, function($table){
      $table->increments("id");
      $table->string("name")->unique();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Undo the migration
   */
  public function down()
  {
    $this->schema->drop($this->tableName);
  }
}
