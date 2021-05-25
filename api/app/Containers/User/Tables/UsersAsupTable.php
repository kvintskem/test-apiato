<?php


namespace App\Containers\User\Tables;


class UsersAsupTable
{
  public const TABLE = 'users_asup';

  public const COLUMNS_ALIAS = ' as asup_';

  public const NUMBER = 'number';

  public const FULLNAME = 'fullname';

  public const EMAIL = 'email';

  public const INTEGRATION_ID = 'integration_id';
  public const ORGID = 'orgid';

  public const CREATED_AT = 'created_at';

  // Дата обнвовления
  public const UPDATED_AT = 'updated_at';

  // Дата удаления
  public const DELETED_AT = 'deleted_at';


  public static $tNUMBER = self::TABLE . '.' . self::NUMBER;
  public static $tFULLNAME = self::TABLE . '.' . self::FULLNAME;
  public static $tEMAIL = self::TABLE . '.' . self::EMAIL;
  public static $tINTEGRATION_ID = self::TABLE . '.' . self::INTEGRATION_ID;

  public const FILLABLE = [
    self::NUMBER,
    self::FULLNAME,
    self::EMAIL,
    self::INTEGRATION_ID,
    self::ORGID,
  ];
}
