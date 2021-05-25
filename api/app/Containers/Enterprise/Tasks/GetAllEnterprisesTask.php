<?php

namespace App\Containers\Enterprise\Tasks;

use App\Containers\Enterprise\Data\Repositories\EnterpriseRepository;
use App\Containers\Enterprise\Data\Validation\SortValidation;
use App\Ship\Parents\Tasks\Task;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllEnterprisesTask extends Task
{

    protected $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $search
     * @param SortValidation $sort
     * @param int|null $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function run($search, int $limit = null)
    {
        $this->addRequestCriteria($this->repository);

        return $this->repository->paginate($limit ?? '*');
    }
}
