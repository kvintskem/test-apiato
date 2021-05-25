<?php

namespace App\Containers\User\Data\Repositories;

use App\Ship\Parents\Repositories\Repository;
use Illuminate\Support\Facades\DB;


class UserAsupRepository extends Repository
{
  use UserRepositoryTrait;

  public function getAllIntegration()
  {
    return DB::table('users_asup')->get()->pluck(['integration_id']);
  }

}
