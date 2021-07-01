<?php


namespace App\Containers\Enterprise\UI\API\Transformers;


use App\Containers\Enterprise\Models\Enterprise;
use App\Ship\Parents\Transformers\Transformer;

class SendMailTransformer extends Transformer
{
    /**
     * @param bool $status
     * @param string $messages
     * @return array
     */
    public function transform(bool $status, string $messages): array
    {
        return [
            'status'      => $status,
            'messages'    => $messages
        ];

    }
}
