<?php

namespace App\Containers\Enterprise\UI\API\Controllers;

use App\Containers\Enterprise\Services\EnterpriseService;
use App\Containers\Enterprise\UI\API\Requests\GetAllEnterprisesRequest;
use App\Containers\Enterprise\UI\API\Transformers\EnterpriseTransformer;
use App\Containers\Enterprise\UI\API\Transformers\SendMailTransformer;
use App\Mail\EnterpriseList;
use App\Ship\Parents\Controllers\ApiController;
use App\Ship\Parents\Exceptions\Exception;
use Illuminate\Support\Facades\Mail;

class Controller extends ApiController
{
    protected $_service;

    public function __construct(EnterpriseService $service)
    {
        $this->_service = $service;
    }

    /**
     * Получить список предприятий
     * @param GetAllEnterprisesRequest $r
     * @return array
     */
    public function getAllEnterprises(GetAllEnterprisesRequest $r): array
    {
        $enterprises = $r->id ? $this->_service->getAllByParent($r->id) : $this->_service->getAll($r->search);

        return $this->transform($enterprises, EnterpriseTransformer::class);
    }

    public function sendEmailEnterpriseList()
    {
        $nameCompany = $this->_service->getQuoteForEnterpriseTask();

        if (empty($nameCompany)) {
            return (new SendMailTransformer())->transform(false, 'Нет компаний у которых превышена квота');
        }

        try {
            Mail::to(env('MAIL_ENTERPRISE_LIST'))->send(new EnterpriseList($nameCompany));
        } catch (Exception $exception) {
            return (new SendMailTransformer())->transform(false, $exception->getMessage());
        }

        return (new SendMailTransformer())->transform(true, 'Письмо отправлено');
    }
}
