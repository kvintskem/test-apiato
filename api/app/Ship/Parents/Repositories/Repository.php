<?php

namespace App\Ship\Parents\Repositories;

use Apiato\Core\Abstracts\Repositories\Repository as AbstractRepository;
use App\Ship\Parents\Policies\Policy;
use Illuminate\Database\Eloquent\Model;
use Request;

/**
 * Class Repository.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
abstract class Repository extends AbstractRepository
{
    protected $user;
    protected $setModel = null;


    public function modelQuery()
    {
        /* @var $model Model */
        $model = $this->model();
        return $model::query();
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        parent::boot();
        $this->user = auth()->user();
    }

    /**
     * Paginate the response
     *
     * Apply pagination to the response. Use ?limit= to specify the amount of entities in the response.
     * The client can request all data (skipping pagination) by applying ?limit=0 to the request, if
     * PAGINATION_SKIP is set to true.
     *
     * @param null $limit
     * @param array $columns
     * @param string $method
     *
     * @return  mixed
     */
    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {

        $limit = $limit ?? Request::get('limit');

        // check, if skipping pagination is allowed and the requested by the user
        if ($limit === '*') {
            return parent::all($columns);
        }

        // check for the maximum entries per pagination
        if (is_int($this->maxPaginationLimit)
            && $this->maxPaginationLimit > 0
            && $limit > $this->maxPaginationLimit
        ) {
            $limit = $this->maxPaginationLimit;
        }

        return parent::paginate($limit, $columns, $method);
    }

    /** Get tree response
     * @param null|int $id
     * @return mixed
     */
    public function getTree($id = null)
    {
        $this->applyCriteria();
        if ($id) {
            return $this->model->descendantsOf($id)->toTree();
        }
        return $this->model->defaultOrder()->get()->toTree();
    }


    public function destroy(array $ids)
    {
        return $this->model()::destroy($ids);
    }

    public function setPolicy($policy, ...$args)
    {
        if (is_string($policy)) {
            $policy = new $policy($args);
        }

        if (!($policy instanceof Policy)) {
            return;
        }
        /** @var Policy $policy */
        return $policy->apply($this, $this->user, $args);
    }

    public function debugSql()
    {
        $this->applyScope();
        $this->applyCriteria();
        return $this->model->toSql();
    }

    public function model()
    {

        if (!empty($this->setModel)) {
            return $this->setModel;
        }

        return parent::model();
    }

}
