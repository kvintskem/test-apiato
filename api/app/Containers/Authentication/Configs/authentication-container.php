<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Authentication Confirmation
  |--------------------------------------------------------------------------
  |
  | When set to true, the user must confirm his email before being able to
  | Login, after his registration.
  |
  */

  'api_token_expires'       => env('JWT_TTL', 60),
  'fails_to_user_lock'      => env('FAILS_TO_USER_LOCK', 0),
  'failed_user_auto_unlock' => env('FAILED_USER_AUTO_UNLOCK', 0),
  'inactive_user_lock'      => env('INACTIVE_USER_LOCK', 0),
  'send_sms_service'        => env('SEND_SMS_SERVICE', true),
   //В часах
  'sms_uncheck_time'        => env('SMS_UNCHECK_TIME', 8),
    //Количество паролей в истории
    'password-history-count' => env('PASSWORD_HISTORY_COUNT', 5),
    'nika_enable'            => env('NIKA_IS_ENABLE',false),
    'nika_base_uri'          => env('NIKA_BASE_URI'),
    'nika_uri'               => env('NIKA_URI'),
];
