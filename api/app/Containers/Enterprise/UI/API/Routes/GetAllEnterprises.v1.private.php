<?php

/**
 * @OA\Get(
 *      path="/enterprises/{id}",
 *      tags={"Enterprises"},
 *      summary="Get all enterprises",
 *      description="Get all enterprises by ID",
 *      security={ {"bearer": {} }},
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *       )
 *     )
 * @var \Illuminate\Routing\Router $router
 */


$router->get('enterprises/{id?}', [
    'as' => 'api_enterprise_get_all_enterprises',
    'uses'  => 'Controller@getAllEnterprises',
    'middleware' => [
      'jwt',
    ],
]);
