<?php


namespace App\Ship\App\Authorization;


class PermissionsTable
{
  public const TABLE = 'permissions';

  public const ID = 'id';
  public const NAME = 'name';
  public const GUARD_NAME = 'guard_name';
  public const DISPLAY_NAME = 'display_name';
  public const DESCRIPTION = 'description';

  public const FILLABLE = [
    self::NAME,
    self::GUARD_NAME,
    self::DISPLAY_NAME,
    self::DESCRIPTION,
  ];
}
