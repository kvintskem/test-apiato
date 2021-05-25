<?php
declare(strict_types=1);

namespace App\Containers\Enterprise\Tests\Traits;

use App\Containers\Enterprise\Models\Enterprise;

trait DeleteEnterprisesTrait
{
    public function deleteEnterprises():void
    {
        Enterprise::query()->delete();
    }
}
