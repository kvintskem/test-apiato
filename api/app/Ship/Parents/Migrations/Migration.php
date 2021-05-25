<?php


namespace App\Ship\Parents\Migrations;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

abstract class Migration extends BaseMigration
{

  public function addMembersFields(string $table): void
  {
    if (Schema::hasTable($table)) {
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN member_groups integer[]  DEFAULT(\'{}\')'); // группы
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN member_users integer[]  DEFAULT(\'{}\')'); // пользователи
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN member_enterprises integer[]  DEFAULT(\'{}\')'); // предприятия
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN member_excludes integer[]  DEFAULT(\'{}\')'); // исключения-пользователи
    }
  }

  public function addShareAccessField(string $table)
  {
    if (Schema::hasTable($table)) {
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN share_access integer[]  DEFAULT(\'{}\')'); // Шаринг доступов/Соавторы
    }
  }

  public function addUsersField(string $table)
  {
    if (Schema::hasTable($table)) {
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN users integer[]  DEFAULT(\'{}\')'); // массив пользователей
    }
  }

  public function addExpertsField(string $table)
  {
    if (Schema::hasTable($table)) {
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN experts integer[]  DEFAULT(\'{}\')');
    }
  }

  public function addJsonInteger(string $table, string $column)
  {
    if (Schema::hasTable($table)) {
      DB::statement('ALTER TABLE ' . $table . ' ADD COLUMN ' . $column . ' integer[]  DEFAULT(\'{}\')');
    }
  }

}
