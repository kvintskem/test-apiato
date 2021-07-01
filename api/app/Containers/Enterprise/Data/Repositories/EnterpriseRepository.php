<?php

namespace App\Containers\Enterprise\Data\Repositories;

use App\Containers\Enterprise\Data\Criteria\FirstLevelCriteria;
use App\Containers\Enterprise\Data\Criteria\SearchEnterpriseCriteria;
use App\Containers\Enterprise\Data\Criteria\SortCriteria;
use App\Ship\Parents\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class EnterpriseRepository
 */
class EnterpriseRepository extends Repository
{
    public function getQuoteForEnterprise()
    {
           return DB::table('enterprises')
                ->select(DB::raw('count(users_asup.number) as count_users_asup, enterprises.objsname, enterprises.objquota'))
                ->join('users_asup', 'enterprises.objid', '=', 'users_asup.orgid')
                ->groupBy('enterprises.objid')
//                ->havingRaw('COUNT(users_asup.number) / enterprises.objquota * 100 >= 80')
                ->get();
    }
}
