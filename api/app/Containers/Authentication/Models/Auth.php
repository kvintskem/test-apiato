<?php

namespace App\Containers\Authentication\Models;

use App\Containers\Authentication\Tables\AuthTable;
use App\Ship\Parents\Models\Model;
use Smiarowski\Postgres\Model\Traits\PostgresArray;

class Auth extends Model
{
    use  PostgresArray;

    public $table = AuthTable::TABLE;

    protected $fillable = AuthTable::FILLABLE;

    public $incrementing = false;

    protected $primaryKey = AuthTable::USER_ID;
}
