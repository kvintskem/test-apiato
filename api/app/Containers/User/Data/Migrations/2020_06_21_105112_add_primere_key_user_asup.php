<?php

use App\Containers\User\Tables\UsersAsupTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPrimereKeyUserAsup extends Migration
{

    public function __construct() {
        // Register _int4 type
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('_int4', 'array');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table(UsersAsupTable::TABLE, function (Blueprint $table) {

            $table->primary(UsersAsupTable::NUMBER);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table(UsersAsupTable::TABLE, function (Blueprint $table) {

            $table->dropPrimary(UsersAsupTable::NUMBER);

        });
    }
}
