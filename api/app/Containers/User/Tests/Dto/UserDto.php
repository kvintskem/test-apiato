<?php

declare(strict_types=1);

namespace App\Containers\User\Tests\Dto;

use App\Containers\User\Models\User;
use App\Containers\User\Models\UserAsup;

final class UserDto
{
    /**
     * @var UserAsup
     */
    private $userAsup;
    /**
     * @var User
     */
    private $user;

    public function __construct(UserAsup $userAsup, User $user)
    {
        $this->userAsup = $userAsup;
        $this->user = $user;
    }

    public function getUserAsup(): UserAsup
    {
        return $this->userAsup;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
