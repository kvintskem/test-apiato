<?php

namespace App\Containers\Authorization\Models;

use Apiato\Core\Traits\HashIdTrait;
use Apiato\Core\Traits\HasResourceKeyTrait;
use App\Containers\Authorization\Values\PermissionIdValue;
use App\Ship\App\Authorization\PermissionsTable;
use App\Ship\Enums\Guard\GuardEnum;
use Spatie\Permission\Models\Permission as SpatiePermission;


class Permission extends SpatiePermission
{

    use HashIdTrait;
    use HasResourceKeyTrait;

    protected $guard_name = GuardEnum::GUARD_NAME;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = PermissionsTable::FILLABLE;

    public function getId():int
    {
        return $this->id;
    }
}
