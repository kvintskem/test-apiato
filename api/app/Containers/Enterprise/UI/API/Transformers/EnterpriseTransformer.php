<?php

namespace App\Containers\Enterprise\UI\API\Transformers;

use App\Containers\Enterprise\Models\Enterprise;
use App\Ship\Parents\Transformers\Transformer;

class EnterpriseTransformer extends Transformer
{
    /**
     * @param Enterprise $entity
     *
     * @return array
     */
    public function transform(Enterprise $entity): array
    {
        return [
            'object'      => 'Enterprise',
            'objid'       => $entity->objid,
            'objidref'    => $entity->objidref,
            'objstatus'   => $entity->objstatus,
            /*'objidbukr'   => $entity->objidbukr,
            'objnamebukr' => $entity->objnamebukr,
            'objlname'    => $entity->objlname,*/
            'objsname'    => $entity->objsname,
        ];

    }
}
