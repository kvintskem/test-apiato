<?php


namespace App\Containers\User\Data\Repositories;


use App\Containers\User\Tables\UsersAsupTable;
use App\Containers\User\Tables\UsersTable;
use Illuminate\Database\Eloquent\Builder;

trait UserRepositoryTrait
{
  public function joinUserTable($model)
  {
    /** @var Builder $model */
    return $model->join('users', UsersTable::$tINTEGRATION_ID, UsersAsupTable::$tINTEGRATION_ID);
  }

}
