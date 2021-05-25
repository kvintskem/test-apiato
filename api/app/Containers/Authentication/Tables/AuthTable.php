<?php

namespace App\Containers\Authentication\Tables;

class AuthTable
{
    public const TABLE = 'auth';

    public const USER_ID = 'user_id';

    public const PASSWORD = 'password';

    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    public static $tUSER_ID = self::TABLE . '.' . self::USER_ID;

    public const FILLABLE = [
        self::USER_ID,
        self::PASSWORD,
    ];
}
