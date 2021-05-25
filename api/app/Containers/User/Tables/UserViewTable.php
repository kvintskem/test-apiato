<?php


namespace App\Containers\User\Tables;


class UserViewTable
{

  public static function defaultField()
  {

    return [

      UsersTable::$tID,

      UsersAsupTable::$tINTEGRATION_ID,
      UsersAsupTable::$tNUMBER,
      UsersAsupTable::$tFULLNAME,

    ];

  }

}
