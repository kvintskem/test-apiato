<?php
declare(strict_types=1);

namespace App\Containers\User\Tests;

use App\Ship\Parents\Tests\PhpUnit\TestCase as ShipTestCase;

class UserTestCase extends ShipTestCase
{
    public function setUp():void
    {
        parent::setUp();
        $this->setUpTestingUser();
    }
}
