<?php

namespace App\Containers\User\Models;

use App\Containers\Authentication\Models\Auth;
use App\Containers\Authentication\Services\UserAuthService;
use App\Containers\FileStore\Services\FileStoreService;
use App\Containers\User\Includes\Groups\GroupModel;
use App\Containers\User\Services\UserService;
use App\Containers\User\Tables\UsersTable;
use App\Ship\Parents\Models\UserModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property UserAsup $user_asup
 * @property Collection $groups
 * @property int id
 * @property int number
 * @property string fullname
 * @property string email
 * @property int stat2
 * @property string integration_id
 * @property string jobtitle
 * @property array numbers
 * @property string objlname
 * @property string orglname
 * @property int avatar
 */
class User extends UserModel
{
    public $table = UsersTable::TABLE;

    protected $guard_name = 'api';

    protected $fillable = UsersTable::FILLABLE;

    protected $appends = ['groups', 'role', 'avatar_info', 'block', 'role_ids', 'block_reason'];


    protected $dates = ['created_at', 'updated_at'];

    protected $resourceKey = UsersTable::TABLE;


    public function getId()
    {
        return $this->id;
    }

    public function getTabnrs()
    {
        $numbers = $this->numbers;
        return $numbers->toArray() ?? [];
    }

    public function getGroupIds(): array
    {
        $groups = $this->getGroups();
        return $groups->map(
            function ($itm) {
                return $itm['id'];
            }
        )->toArray();
    }

    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function getEnterprises(): array
    {
        $enterprises = $this->{'enterprises'};
        return $enterprises->toArray();
    }

    public function getEmail()
    {
        $email = $this->email ?? null;
        if (empty($email)) {
            $email = $this->user_asup->email ?? null;
        }
        return $email;
    }

    /**
     * Используется в шаблоне уведомления о смене пароля
     * @return false|string
     */
    public function blockDate()
    {
        $auth = Auth::where('user_id', $this->id)->first();
        return date("d.m.Y", strtotime($auth->getPasswordDate().'+'.env('PASSWORD_EXPIRATION_TIME') .'day'));
    }

    public function getOrglname()
    {
        return $this->orglname ?? $this->user_asup->orglname ?? null;
    }

    public function getObjlname(): ?string
    {
        return $this->objlname ?? $this->user_asup->objlname ?? null;
    }

    public function getJobtitle(): ?string
    {
        return $this->jobtitle ?? $this->user_asup->jobtitle ?? null;
    }

    public function getTabnrsAttribute()
    {
        $user = UserAsup::query()
            ->where('integration_id', $this->getIntegrationid())
            ->get();
        return $user->map(
            function ($itm) {
                return $itm->number;
            }
        );
    }

    public function getIntegrationid()
    {
        return $this->integration_id ?? null;
    }

    public function getEnterprisesAttribute()
    {
        $user = UserAsup::query()
            ->where('integration_id', $this->getIntegrationid())
            ->get();
        return $user->map(
            function ($itm) {
                return $itm->orgid;
            }
        );
    }

    public function getGroupsAttribute()
    {
        $groups = GroupModel::query()
            ->where('users', '&&', DB::raw('ARRAY[' . $this->getTabnr() . ']'))
            ->get();
        return $groups->map(
            function ($group) {
                return [
                    'id' => $group->id,
                    'name' => $group->name,
                ];
            }
        );
    }

    public function getTabnr()
    {
        $number = $this->number ?? null;
        if (empty($number)) {
            $number = $this->user_asup->number ?? null;
        }
        return $number;
    }

    public function getRoleAttribute()
    {
        $roles = $this->roles()->get();
        return $roles->map(
            function ($role) {
                return [
                    'id' => $role->id,
                    'name' => $role->name,
                ];
            }
        );
    }

    public function getRoleIdsAttribute()
    {
        $roles = $this->roles()->get();
        return $roles->map(
            function ($role) {
                return $role->id;
            }
        );
    }

    public function getAvatarInfoAttribute()
    {
        $fileService = new FileStoreService();
        $avatar = $this->attributes['avatar'];
        if (!empty($avatar)) {
            return $fileService->getById($avatar);
        }

        return null;
    }

    public function getAvatarAttribute()
    {
        $fileService = new FileStoreService();
        if (!empty($this->avatar)) {
            return $fileService->getById($this->avatar);
        }

        return null;
    }

    public function getBlockAttribute()
    {
        $userAuth = new UserAuthService();
        $userAuthData = $userAuth->getById($this->id);

        return $userAuthData->is_block ?? false;
    }

    public function user_asup()
    {
        return $this->hasOne(UserAsup::class, 'integration_id', 'integration_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getBlockReasonAttribute(): ?string
    {
        /** @var Auth $userAuth */
        $userAuth = $this->auth()->first();

        if ($userAuth) {
            if ($userAuth->getBlockReasonValue() === null) {
                return null;
            }
            return $userAuth->getBlockReasonValue()->getReasonText();
        }

        return null;
    }

    public function auth()
    {
        return $this->hasOne(Auth::class, 'user_id', 'id');
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        $dataUser = (new UserService())->getByIntegrationId($this->integration_id);

        /* @var $dataUser Collection */
        $number = $dataUser->map(
            function ($item) {
                return $item->number;
            }
        );

        return [
            'id' => $this->id,
            'number' => $number ?? [],
            'fullname' => $this->getFullName() ?? [],
        ];
    }

    public function getFullName()
    {
        $fullname = $this->fullname ?? null;
        if (empty($fullname)) {
            $fullname = $this->user_asup->fullname ?? null;
        }
        return $fullname;
    }

    public function getStat2()
    {
        return $this->stat2 ?? $this->user_asup->stat2 ?? null;
    }

    public function onesignalIds()
    {
        return $this->hasMany(UserOnesignalId::class);
    }
}
