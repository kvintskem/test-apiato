<?php

namespace App\Containers\Authentication\Tests\Helper;

use App\Containers\Enterprise\Models\Enterprise;
use App\Containers\User\Models\User;
use App\Containers\User\Models\UserAsup;
use App\Containers\User\Tables\UsersTable;
use App\Ship\Parents\Models\UserModel;
use Smiarowski\Postgres\Model\Traits\PostgresArray;
use Tymon\JWTAuth\Facades\JWTAuth;


trait TestAuthenticationHelperTrait
{
    public function getAuthorizationParams(): array
    {
        return [
            'Authorization' => sprintf('Bearer %s', $this->token),
        ];
    }

    public function setUpTestingUser()
    {
        $this->testingUser = $this->getUserForTest();
        $this->actingAs($this->testingUser, 'api');
        $this->token = JWTAuth::fromUser($this->testingUser);
    }

    public function getEnterpriseForTest():Enterprise
    {
        $headEnterpriseId = $this->getRandomEnterpriseId();
        return factory(Enterprise::class)->create(
            [
                'objid' => $headEnterpriseId,
                'objidref' => 8800000,
                'objsname' => 'Головной офис',
                'objstatus' => null,
                'is_root' => false,
                'parents' => PostgresArray::mutateToPgArray([$headEnterpriseId]),
            ]
        );
    }

    /**
     * @param array $params
     * @return UserModel|User
     * @throws \Exception
     */
    public function getUserForTest(array $params = []): UserModel
    {
        $enterprise = Enterprise::all()->last();
        if ($enterprise === null) {
            $enterprise = $this->getEnterpriseForTest();
        }

        if (!isset($params['user_asup']['integration_id'])) {
            $params['user_asup']['integration_id'] = random_int(1, 1000000);
        }

        /** @var User $user */
        factory(User::class)->create(
            [
                'integration_id' => $params['user_asup']['integration_id']
            ]
        );

        $userAsupParams = [
            'orgid' => $enterprise->objid,
        ];

        if (isset($params['user_asup']) && is_array($params['user_asup'])) {
            $userAsupParams = array_merge(
                $params['user_asup'],
                $userAsupParams
            );
        }

        $userAsup = factory(UserAsup::class)->create(
            $userAsupParams
        );


        /** @var User $user */
        return User::query()->where(
            UsersTable::INTEGRATION_ID,
            $userAsup->getIntegrationid()
        )
            ->get()->first();
    }
}
