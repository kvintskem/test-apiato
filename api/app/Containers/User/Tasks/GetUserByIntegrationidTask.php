<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Data\Repositories\UserRepository;
use App\Containers\User\Tables\UsersAsupTable;
use App\Ship\Parents\Tasks\Task;
use Illuminate\Database\Eloquent\Builder;


class GetUserByIntegrationidTask extends Task
{
  protected $repository;

  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  public function run($integration_number, array $exludes = null, int $limit = null, array $search = [], array $sort = [], $active = false)
  {
    return $this->repository->scopeQuery(function ($model) use ($integration_number, $active) {

      /** @var Builder $model */
      $model = $this->repository->scopeJoinUserAsup($model);

      $model = is_array($integration_number)
        ? $model->whereIn(UsersAsupTable::$tNUMBER, $integration_number)
        : $model->where(UsersAsupTable::$tNUMBER, (int)$integration_number);

      $model = $model->where(UsersAsupTable::$tINTEGRATION_ID, '<>','');

      return $model;

    })->paginate('*');

  }
}
