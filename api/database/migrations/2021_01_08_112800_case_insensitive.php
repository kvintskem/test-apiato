<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

final class CaseInsensitive extends Migration
{
    public function up():void
    {
        DB::statement('ALTER TABLE users_asup ALTER COLUMN fullname TYPE citext');
    }

    public function down():void
    {
        DB::statement('ALTER TABLE users_asup ALTER COLUMN fullname TYPE varchar(255)');
    }
}
