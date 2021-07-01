<?php

namespace App\Containers\Enterprise\Tasks;

use App\Containers\Enterprise\Data\Repositories\EnterpriseRepository;
use App\Ship\Parents\Tasks\Task;

class GetQuoteForEnterpriseTask extends Task
{
    protected $repository;

    public function __construct(EnterpriseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        $nameCompany = [];
        $result = $this->repository->getQuoteForEnterprise();

        foreach ($result as $enterprise) {
            if (($enterprise->count_users_asup / $enterprise->objquota * 100) >= 80) {
                $nameCompany[] = $enterprise->objsname;
            }
        }

        return $nameCompany;
    }
}
