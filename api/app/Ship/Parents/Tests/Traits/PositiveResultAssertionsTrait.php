<?php

namespace App\Ship\Parents\Tests\Traits;

use App\Ship\Parents\Models\Model;
use Illuminate\Foundation\Testing\TestResponse;

trait PositiveResultAssertionsTrait
{
    protected function positiveResultAssertions(Model $expectedResult, TestResponse $response):void
    {
        $decodedResponse = $response->decodeResponseJson();

        $data = $decodedResponse['data'];
        self::assertCount(1, $data);
        $firstResult = $data[0];
        self::assertSame($expectedResult->getAttribute('id'), $firstResult['id']);
    }
}
