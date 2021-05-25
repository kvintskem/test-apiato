<?php

namespace App\Ship\Fractal;

use League\Fractal\Serializer\ArraySerializer as CoreArraySerializer;

/**
 * {@inheritdoc}
 */
class ArraySerializer extends CoreArraySerializer
{

    const RESOURCE_KEY = 'data';

    /**
     * {@inheritdoc}
     */
    public function collection($resourceKey, array $data)
    {
        if ($resourceKey == self::RESOURCE_KEY) {
            return [$resourceKey => $data];
        }
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function item($resourceKey, array $data)
    {
        if ($resourceKey == self::RESOURCE_KEY) {
            return [$resourceKey => $data];
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function null()
    {
        return ['data' => []];
    }
}
