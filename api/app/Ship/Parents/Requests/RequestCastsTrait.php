<?php

namespace App\Ship\Parents\Requests;

/**
 * Расширяем класс Request. Добавляем возможность приводить аттрибуты к нужным типам прямо в нем
 * @see https://laravel.com/docs/7.x/eloquent-mutators#attribute-casting
 */
trait RequestCastsTrait
{

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Приводи
     * @param array $requestData
     * @return array
     */
    protected function casts(array $requestData): array
    {
        $attributes = $requestData;

        foreach ($this->getCasts() as $key => $value) {
            if (!array_key_exists($key, $requestData)) {
                continue;
            }

            // Here we will cast the attribute. Then, if the cast is a date or datetime cast
            // then we will serialize the date for the array. This will convert the dates
            // to strings based on the date format specified for these Request Apiato.
            $attributes[$key] = $this->castAttribute(
                $key,
                $attributes[$key]
            );
        }

        return $attributes;
    }

    /**
     * Get the casts array.
     *
     * @return array
     */
    public function getCasts(): array
    {
        return $this->casts;
    }

    /**
     * Cast an attribute to a native PHP type.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return $value;
        }

        switch ($this->getCastType($key)) {
            case 'int':
            case 'integer':
                return (int)$value;
            case 'real':
            case 'float':
            case 'double':
                return (float)$value;
            case 'string':
                return (string)$value;
            case 'bool':
            case 'boolean':
                return (bool)$value;
            case 'object':
                return $this->fromJson($value, true);
            case 'array':
            case 'json':
                return $this->fromJson($value);
            //TO DO Подумать как быть с датами в проекте.
            /* case 'date':
              return $this->asDate($value);
              case 'datetime':
              case 'timestamp':
              return $this->asTimestamp($value);
             */
            default:
                return $value;
        }
    }

    /**
     * Get the type of cast for a model attribute.
     *
     * @param string $key
     * @return string
     */
    protected function getCastType($key)
    {
        return trim(strtolower($this->getCasts()[$key]));
    }

    /**
     * Decode the given JSON back into an array or object.
     *
     * @param string $value
     * @param bool $asObject
     * @return mixed
     */
    public function fromJson($value, $asObject = false)
    {
        return json_decode($value, !$asObject);
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format($this->getDateFormat());
    }
}
