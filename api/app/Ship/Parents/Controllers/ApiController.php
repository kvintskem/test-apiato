<?php

namespace App\Ship\Parents\Controllers;

use Apiato\Core\Abstracts\Controllers\ApiController as AbstractApiController;
use Apiato\Core\Abstracts\Transformers\Transformer;
use Fractal;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;
use Request;
use App\Ship\Fractal\ArraySerializer;

/**
 * {@inheritdoc}
 * @OA\Info(
 *      version="1.0.0",
 *      title="NNG Documentation",
 *      description="NNG Apiato Swagger OpenApi description",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )

 *
 * @OA\Tag(
 *     name="NNG",
 *     description="API Endpoints of Projects"
 * )
 * 
 */

abstract class ApiController extends AbstractApiController
{

    /**
     * {@inheritdoc}
     */
    public function transform(
    $data,
    $transformerName = null,
    array $includes = [],
    array $meta = [],
    $resourceKey = 'data'
    )
    {
        // create instance of the transformer
        $transformer = new $transformerName;

        // if an instance of Transformer was passed
        if ($transformerName instanceof Transformer) {
            $transformer = $transformerName;
        }

        // append the includes from the transform() to the defaultIncludes
        $includes = array_unique(array_merge($transformer->getDefaultIncludes(), $includes));

        // set the relationships to be included
        $transformer->setDefaultIncludes($includes);

        // add specific meta information to the response message
        $this->metaData = [
            'include' => $transformer->getAvailableIncludes(),
            'custom'  => $meta,
        ];

        //TO DO До лучших времен.
        // no resource key was set
        /* 
         * if (!$resourceKey) {
            // get the resource key from the model
            $obj = null;
            if ($data instanceof AbstractPaginator) {
                $obj = $data->getCollection()->first();
            } elseif ($data instanceof Collection) {
                $obj = $data->first();
            } else {
                $obj = $data;
            }

            // if we have an object, try to get its resourceKey
            if ($obj) {
                $resourceKey = $obj->getResourceKey();
            }
        }*/
        
        //Игнорируем любые ключи, которые передаются напрямую в контроллер. Оставляя только DATA
        $resourceKey = 'data';

        $fractal = Fractal::create($data, $transformer, new ArraySerializer())->withResourceName($resourceKey)->addMeta($this->metaData);
        // check if the user wants to include additional relationships
        if ($requestIncludes = Request::get('include')) {
            $fractal->parseIncludes($requestIncludes);
        }

        // apply request filters if available in the request
        if ($requestFilters = Request::get('filter')) {
            $result = $this->filterResponse($fractal->toArray(), explode(';', $requestFilters));
        } else {
            $result = $fractal->toArray();
        }

        return $result;
    }
}
