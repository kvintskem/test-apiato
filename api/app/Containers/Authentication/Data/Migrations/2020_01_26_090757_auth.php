<?php

use App\Containers\Authentication\Tables\AuthTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Auth extends Migration
{

  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create(AuthTable::TABLE, function (Blueprint $table) {

      $table->integer(AuthTable::USER_ID);
      $table->string(AuthTable::PASSWORD)->nullable();

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists(AuthTable::TABLE);
  }
}
