<?php

namespace App\Containers\User\Data\Repositories;

use App\Containers\User\Enums\SearchUserFieldsEnum;
use App\Containers\User\Enums\SortUserFieldsEnum;
use App\Containers\User\Includes\Enterprise\EnterpriseTableInc;
use App\Containers\User\Includes\Groups\GroupsTableInc;
use App\Containers\User\Tables\UsersAsupTable;
use App\Containers\User\Tables\UsersTable;
use App\Ship\Parents\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 */
class UserRepository extends Repository
{

  public function scopeJoinUserAsup($model)
  {
    /** @var Builder $model */
    return $model->join(UsersAsupTable::TABLE, UsersAsupTable::$tINTEGRATION_ID, UsersTable::$tINTEGRATION_ID);
  }

}
