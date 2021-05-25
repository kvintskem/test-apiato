<?php
declare(strict_types=1);

namespace App\Containers\User\Tests\Traits;

use App\Containers\Authorization\Models\Permission;
use App\Containers\User\Enums\Permission as UserPermission;

trait UserPermissionSeederTrait
{
    final public function seedUserPermissions():void
    {
        $arrayOfPermissionNames = [
            UserPermission::ACCESS,
        ];

        foreach ($arrayOfPermissionNames as $permission) {
            factory(Permission::class)->create([
                'name' => $permission
            ]);
        }
    }
}
