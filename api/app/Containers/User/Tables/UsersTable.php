<?php


namespace App\Containers\User\Tables;


class UsersTable
{
    public const TABLE = 'users';

    // id
    public const ID = 'id';

    // integration_id ользователя в асуп системе
    public const INTEGRATION_ID = 'integration_id';

    // автарка пользователя
    public const AVATAR = 'avatar';

    // Инфа о пользователе
    public const ABOUT_ME = 'about_me';

    // Номер телефона
    public const PHONE = 'phone';

    //Тип пользователя
    public const TYPE = 'type';


    // Дата создания
    public const CREATED_AT = 'created_at';

    // Дата обнвовления
    public const UPDATED_AT = 'updated_at';

    // Дата удаления
    public const DELETED_AT = 'deleted_at';


    public static $tID = self::TABLE . '.' . self::ID;
    public static $tINTEGRATION_ID = self::TABLE . '.' . self::INTEGRATION_ID;
    public static $tAVATAR = self::TABLE . '.' . self::AVATAR;
    public static $tABOUT_ME = self::TABLE . '.' . self::ABOUT_ME;
    public static $tPHONE = self::TABLE . '.' . self::PHONE;
    public static $tTYPE = self::TABLE . '.' . self::TYPE;
    public static $tCREATED_AT = self::TABLE . '.' . self::CREATED_AT;

    public const FILLABLE = [
        self::INTEGRATION_ID,
        self::AVATAR,
        self::ABOUT_ME,
        self::PHONE,
        self::TYPE,
    ];
}
