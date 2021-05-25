<?php


namespace App\Containers\User\Enums;


use App\Containers\User\Tables\UsersAsupTable;
use App\Containers\User\Tables\UsersTable;

class SortUserFieldsEnum
{

  public const ID = 'id';
  public const BUKR = 'bukr';
  public const FULLNAME = 'fullname';
  public const INTEGRATION_ID = 'integration_id';
  public const NUMBER = 'number';
  public const ORGID = 'orgid';
  public const ORGNAME = 'orgname';
  public const ORGLNAME = 'orglname';
  public const OBJID = 'objid';
  public const OBJNAME = 'objname';
  public const OBJLNAME = 'objlname';
  public const JOBID = 'jobid';
  public const JOBTITLE = 'jobtitle';
  public const PRIVEMOBTEL = 'privemobtel';
  public const EMAIL = 'email';
  public const IS_ACTIVE = 'is_active';


  public static $fields = [
    self::ID          => UsersTable::TABLE . '.' . UsersTable::ID,
    self::BUKR        => UsersAsupTable::TABLE . '.' . UsersAsupTable::BUKR,
    self::FULLNAME    => UsersAsupTable::TABLE . '.' . UsersAsupTable::FULLNAME,
    self::INTEGRATION_ID     => UsersAsupTable::TABLE . '.' . UsersAsupTable::INTEGRATION_ID,
    self::NUMBER       => UsersAsupTable::TABLE . '.' . UsersAsupTable::NUMBER,
    self::ORGID       => UsersAsupTable::TABLE . '.' . UsersAsupTable::ORGID,
    self::ORGNAME     => UsersAsupTable::TABLE . '.' . UsersAsupTable::ORGLNAME,
    self::ORGLNAME    => UsersAsupTable::TABLE . '.' . UsersAsupTable::ORGLNAME,
    self::OBJID       => UsersAsupTable::TABLE . '.' . UsersAsupTable::OBJID,
    self::OBJNAME     => UsersAsupTable::TABLE . '.' . UsersAsupTable::OBJLNAME,
    self::OBJLNAME    => UsersAsupTable::TABLE . '.' . UsersAsupTable::OBJLNAME,
    self::JOBID       => UsersAsupTable::TABLE . '.' . UsersAsupTable::JOBID,
    self::JOBTITLE    => UsersAsupTable::TABLE . '.' . UsersAsupTable::JOBTITLE,
    self::PRIVEMOBTEL => UsersAsupTable::TABLE . '.' . UsersAsupTable::PRIVEMOBTEL,
    self::EMAIL       => UsersAsupTable::TABLE . '.' . UsersAsupTable::EMAIL,
    self::IS_ACTIVE   => UsersAsupTable::TABLE . '.' . UsersAsupTable::IS_ACTIVE,
  ];


  public static function check(string $field)
  {
    if (!array_key_exists($field, self::$fields)) {
      throw new \RuntimeException('Sort field no exist');
    }
    return self::$fields[$field];
  }

}
