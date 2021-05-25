<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyUsersAsupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users_asup', function (Blueprint $table) {
            $table
                ->foreign('integration_id', 'fk-users_asup-integration_id')
                ->references('integration_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users_asup', function (Blueprint $table) {
            $table->dropForeign('fk-users_asup-integration_id');
        });
    }
}
