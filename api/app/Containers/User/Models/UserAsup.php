<?php

namespace App\Containers\User\Models;

use App\Containers\User\Tables\UsersAsupTable;
use App\Ship\Parents\Models\Model;

/**
 * @property int number
 * @property string fullname
 * @property string integration_id
 * @property string email
 */
class UserAsup extends Model
{
  public $table = 'users_asup';

  protected $fillable = UsersAsupTable::FILLABLE;

  protected $primaryKey = 'number';

  public $incrementing = false;


  protected $dates = [ 'created_at', 'updated_at'];


  public function getIntegrationid()
  {
    return $this->integration_id;
  }

  /**
   * A resource key to be used by the the JSON API Serializer responses.
   */
  protected $resourceKey = UsersAsupTable::TABLE;
}
