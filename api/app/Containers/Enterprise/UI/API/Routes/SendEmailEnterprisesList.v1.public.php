<?php

/**
 * @apiGroup           Enterprise
 * @apiName            sendEmailEnterpriseList
 *
 * @api                {GET} /v1/enterprise/send-email-list Endpoint title here..
 * @apiDescription     Endpoint description here..
 *
 * @apiVersion         1.0.0
 * @apiPermission      none
 *
 * @apiParam           {String}  parameters here..
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
  // Insert the response of the request here...
}
 */

/** @var Route $router */
$router->get('enterprise/send-email-list', [
    'as' => 'api_enterprise_send_email_enterprise_list',
    'uses'  => 'Controller@sendEmailEnterpriseList',
    'middleware' => [
      'jwt',
    ],
]);
