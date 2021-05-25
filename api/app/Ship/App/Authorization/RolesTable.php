<?php


namespace App\Ship\App\Authorization;


class RolesTable
{
  public const TABLE = 'roles';

  public const ID = 'id';
  public const NAME = 'name';
  public const GUARD_NAME = 'guard_name';
  public const DISPLAY_NAME = 'display_name';
  public const DESCRIPTION = 'description';
  public const LEVEL = 'level';
  public const ORDER = 'order';

  public const FILLABLE = [
    self::NAME,
    self::GUARD_NAME,
    self::DISPLAY_NAME,
    self::DESCRIPTION,
    self::LEVEL,
    self::ORDER,
  ];
}
