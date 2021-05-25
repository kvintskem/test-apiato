<?php

use App\Ship\App\Enterprise\EnterpriseTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnterpriseTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(EnterpriseTable::TABLE, function (Blueprint $table) {
            $table->increments(EnterpriseTable::ID); // ID OE
            $table->integer(EnterpriseTable::IDREF)->index(); // ID parent
            $table->string(EnterpriseTable::SNAME, 255); // Код OE
            $table->string(EnterpriseTable::STATUS, 40)->nullable(); // Статус ОЕ
            $table->boolean(EnterpriseTable::IS_ROOT)->default(false); // Root элемент
        });

        DB::statement('ALTER TABLE ' . EnterpriseTable::TABLE . ' ADD COLUMN ' . EnterpriseTable::PARENTS . ' integer[]');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(EnterpriseTable::TABLE);
    }
}
