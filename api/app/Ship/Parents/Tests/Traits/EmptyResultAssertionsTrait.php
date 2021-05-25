<?php

namespace App\Ship\Parents\Tests\Traits;

use Illuminate\Foundation\Testing\TestResponse;

trait EmptyResultAssertionsTrait
{
    protected function emptyResultAssertions(TestResponse $response): void
    {
        $decodedResponse = $response->decodeResponseJson();
        $data = $decodedResponse['data'];
        self::assertEmpty($data);
    }
}
