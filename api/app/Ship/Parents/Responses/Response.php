<?php


namespace App\Ship\Parents\Responses;


use App\Ship\Parents\Models\Model;
use Illuminate\Support\Collection;

abstract class Response
{
  /**
   * @param Model $entity
   * @return array
   */
  public static function get($entity): array
  {
    return static::format($entity);
  }

  public static function collection(Collection $collection)
  {
    return $collection->transform(function ($entity) {return static::format($entity);});
  }

  /**
   * @param Model $entity
   * @return array
   */
  abstract public static function format($entity): array;
}
