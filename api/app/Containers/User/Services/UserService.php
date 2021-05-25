<?php

namespace App\Containers\User\Services;

use Apiato\Core\Foundation\Facades\Apiato;


class UserService
{
    public function getByIntegrationId(string $integration_id)
    {
        return Apiato::call('User@GetUserByIntegrationidTask', [$integration_id]);
    }
}
