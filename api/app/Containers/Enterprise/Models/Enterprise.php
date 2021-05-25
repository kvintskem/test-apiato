<?php

namespace App\Containers\Enterprise\Models;

use App\Ship\App\Enterprise\EnterpriseTable;
use App\Ship\Parents\Models\Model;
use Smiarowski\Postgres\Model\Traits\PostgresArray;

class Enterprise extends Model
{
    use PostgresArray;

    public const MODERATORS = 'moderators';

    public $table = EnterpriseTable::TABLE;

    protected $primaryKey = EnterpriseTable::ID;

    public $timestamps = false;

    protected $fillable = EnterpriseTable::FILLABLE;

    public $inEntity = false;
    public $children_count = 0;
    public $parents_names = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * A resource key to be used by the the JSON API Serializer responses.
     */
    protected $resourceKey = EnterpriseTable::TABLE;

    public function getParentsAttribute($value)
    {
        return self::accessPgArray($value);
    }
}
