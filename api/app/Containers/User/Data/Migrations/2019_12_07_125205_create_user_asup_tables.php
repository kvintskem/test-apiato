<?php

use App\Containers\User\Tables\UsersAsupTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAsupTables extends Migration
{

    public function up()
    {
        Schema::create(UsersAsupTable::TABLE, function (Blueprint $table) {
            $table->integer(UsersAsupTable::NUMBER);
            $table->string(UsersAsupTable::FULLNAME, 255);
            $table->string(UsersAsupTable::EMAIL, 255)->nullable();
            $table->string(UsersAsupTable::INTEGRATION_ID, 255);
            $table->integer(UsersAsupTable::ORGID);
            $table->timestamps();

            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(UsersAsupTable::TABLE);
    }
}
