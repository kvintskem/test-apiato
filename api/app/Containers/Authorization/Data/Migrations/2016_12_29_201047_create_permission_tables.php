<?php

use App\Ship\App\Authorization\PermissionsTable;
use App\Ship\App\Authorization\RolesTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $tableNames = config('permission.table_names');
    $foreignKeys = config('permission.foreign_keys');

    Schema::create(PermissionsTable::TABLE, function (Blueprint $table) {
      $table->increments(PermissionsTable::ID);
      $table->string(PermissionsTable::NAME);
      $table->string(PermissionsTable::GUARD_NAME);
      $table->string(PermissionsTable::DISPLAY_NAME)->nullable();
      $table->string(PermissionsTable::DESCRIPTION)->nullable();
      $table->timestamps();
    });

    Schema::create(RolesTable::TABLE, function (Blueprint $table) {
      $table->increments(RolesTable::ID);
      $table->string(RolesTable::NAME);
      $table->string(RolesTable::GUARD_NAME);
      $table->string(RolesTable::DISPLAY_NAME)->nullable();
      $table->string(RolesTable::DESCRIPTION)->nullable();
      $table->unsignedInteger(RolesTable::LEVEL)->default(0);
      $table->integer(RolesTable::ORDER)->nullable();
      $table->timestamps();
    });

    Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $foreignKeys) {
      $table->integer('permission_id')->unsigned();
      $table->morphs('model');

      $table->foreign('permission_id')
        ->references('id')
        ->on(PermissionsTable::TABLE)
        ->onDelete('cascade');

      $table->primary(['model_type', 'model_id', 'permission_id']);
    });

    Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $foreignKeys) {
      $table->integer('role_id')->unsigned();
      $table->morphs('model');

      $table->foreign('role_id')
        ->references('id')
        ->on(RolesTable::TABLE)
        ->onDelete('cascade');

      $table->primary(['model_id', 'role_id', 'model_type']);
    });

    Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
      $table->integer('permission_id')->unsigned();
      $table->integer('role_id')->unsigned();

      $table->foreign('permission_id')
        ->references('id')
        ->on(PermissionsTable::TABLE)
        ->onDelete('cascade');

      $table->foreign('role_id')
        ->references('id')
        ->on(RolesTable::TABLE)
        ->onDelete('cascade');

      $table->primary(['role_id', 'permission_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    $tableNames = config('permission.table_names');

    Schema::drop($tableNames['role_has_permissions']);
    Schema::drop($tableNames['model_has_roles']);
    Schema::drop($tableNames['model_has_permissions']);
    Schema::drop(RolesTable::TABLE);
    Schema::drop(PermissionsTable::TABLE);
  }
}
