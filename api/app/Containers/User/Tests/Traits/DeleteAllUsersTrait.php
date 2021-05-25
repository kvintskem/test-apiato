<?php
declare(strict_types=1);

namespace App\Containers\User\Tests\Traits;

use App\Containers\Authentication\Models\Auth;
use App\Containers\User\Models\User;
use App\Containers\User\Models\UserAsup;

trait DeleteAllUsersTrait
{
    final public function deleteAllUsers():void
    {
        Auth::query()->delete();
        User::query()->delete();
        UserAsup::query()->delete();
    }
}
