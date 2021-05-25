<?php

namespace App\Ship\Parents\Policies;

use Apiato\Core\Abstracts\Policies\Policy as AbstractPolicy;
use App\Ship\Parents\Repositories\Repository;
use Illuminate\Foundation\Auth\User;

/**
 * Class Policy.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Policy extends AbstractPolicy
{
  public function apply(Repository $repository, $user){}
}
