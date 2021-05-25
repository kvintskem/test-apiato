<?php
declare(strict_types=1);

namespace App\Containers\Enterprise\Tests\V1;

use App\Containers\Enterprise\Tests\EnterpriseTestCase;

final class GetAllEnterprisesTest extends EnterpriseTestCase
{
    protected $endpoint = 'get@/v1/enterprises';

    public function testItGetsEnterprises():void
    {
        $enterprise = $this->getEnterpriseForTest();
        $response = $this->makeCall(
            [],
            $this->getAuthorizationParams()
        );
        $data = $response->decodeResponseJson()['data'];
        self::assertSame($enterprise->getAttribute('objid'), $data[1]['objid']);
    }
}
