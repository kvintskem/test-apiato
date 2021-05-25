<?php
declare(strict_types=1);

namespace App\Ship\Parents\Tests\Traits;


trait ShouldNotRefreshDBTrait
{
    public function shouldRefreshDB():bool
    {
        $this->artisan('migrate');
        return false;
    }
}
