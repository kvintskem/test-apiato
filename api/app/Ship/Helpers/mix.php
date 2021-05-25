<?php

/*
|--------------------------------------------------------------------------
| Helpers functions
|--------------------------------------------------------------------------
| Warning:
| Use only 'snake_case' function name.
| Example: 'fuck_you'
*/

use App\Containers\User\Models\User;

function stringToArray(?string $str, string $delimiter = ',')
{
    if (empty($str)) {
        return null;
    }
    return array_filter(array_map('trim', explode($delimiter, $str)));
}

/**
 * Convert array to string
 * @param array|null $data
 * @param string $delimiter
 * @return string|null
 */
function array_to_string(?array $data, string $delimiter = ','): ?string
{
    return !empty($data) ? implode($delimiter, $data) : null;
}

function one_layer_array_to_string(?array $data, $glue = ',') : string
{
  if (empty($data)) {
    return '';
  }

  $processed = array_filter($data, function ($item) {
    if (!is_array($item)) {
      return $item;
    }
    return false;
  });

  return array_to_string($processed, $glue) ?? '';
}

/**
 * Get User Enterprises: Auth, Token
 * @return mixed
 */
function get_user_enterprises()
{
    return (auth('api')->payload())['enterprises'];
}

/**
 * Get User Groups: Auth, Token
 * @return mixed
 */
function get_user_groups()
{
    return (auth('api')->payload())['groups'];
}

/**
 * Get User Role: Auth, Token
 * @return mixed
 */
function get_user_role()
{
    return (auth('api')->payload())['role'];
}

/**
 * Convert array to array postgres
 * @param array|null $array
 * @return mixed
 */
function toPgArray(?array $array)
{
    $string = str_replace(['[', ']', '"'], ['{', '}', '\''], json_encode($array ?? [], JSON_UNESCAPED_UNICODE));
    return $string;
}

/**
 * Convert array postgres to array
 * @param null|string $string
 * @return mixed
 */
function pgToArray(?string $string)
{
    $string = str_replace(['{', '}', '\'', '""'], ['[', ']', '"', '"'], $string);
    return json_decode($string, true);
}


/**
 *  Debug function
 * @param $data
 * @param bool $die
 */
function pr($data, $die = true)
{
    print_r($data);
    !$die ?: die();
}

/**
 * Convert object to array with key
 * @param $data
 * @param $key_name
 * @return mixed
 */
function obj_to_arr_key($data, $key_name)
{
    return $data->map(function ($item) use ($key_name) {
        return $item[$key_name];
    })->toArray();
}

/**
 * Convert date to iso format 8601
 * @param string $value
 * @return mixed
 */
function iso_format(string $value)
{
   return (new Illuminate\Support\Carbon($value))->toIso8601String();
}

function generate_code(string $identity): string
{
    return $identity . substr(microtime(), -6);
}

if (!function_exists('user_tabnr')) {
  /**
   * @return int
   */
  function user_tabnr()
  {
      /** @var User $user */
    $user = auth()->user();
    if (!$user) {
      return null;
    }

    return $user->getTabnr() ?? null;
  }
}

/**
 * Проверка на вход с мобильного пириложения
 */
if (!function_exists('is_mobile_app')) {

  /**
   * @return bool
   */
  function is_mobile_app()
  {
      return isset(getallheaders()['Device-Udid']);
  }
}
