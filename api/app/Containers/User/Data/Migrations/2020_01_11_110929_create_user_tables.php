<?php


use App\Containers\User\Tables\UsersTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTables extends Migration
{

  protected $table = UsersTable::TABLE;

  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create($this->table, function (Blueprint $table) {

      $table->increments(UsersTable::ID);

      $table->string(UsersTable::INTEGRATION_ID, '255')->unique()->nullable(); // Номер СНИЛС
      $table->string(UsersTable::TYPE, '255'); // Тип пользователя

      $table->timestamps();
      $table->softDeletes();

    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists($this->table);
  }
}
