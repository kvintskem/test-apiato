<?php

namespace App\Ship\Parents\Requests;

use Apiato\Core\Abstracts\Requests\Request as AbstractRequest;
use Illuminate\Http\JsonResponse;

/**
 * Class Request
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
abstract class Request extends AbstractRequest
{

    use RequestCastsTrait;

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse(['data' => [
                'status'   => 'error',
                'messages' => $validator->errors()
            ]], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }

    /**
     * Overriding this function to modify the any user input before
     * applying the validation rules.
     *
     * @param null $keys
     *
     * @return  array
     */
    public function all($keys = null)
    {
        $requestData = parent::all($keys);
        /*todo когда все переключатся
         * if (isset($requestData->entity_type)) {
            $requestData->entity_type = $this->parse($requestData->entity_type);
        }*/
        return $this->casts($requestData);
    }

    public function allWithParseMembers($keys = null): array
    {
        $data = $this->all($keys);

        if (!isset($data['members_block'])) {
            return $data;
        }

        $membersBlock = [
            'member_users' => (array) $data['members_block']['member_users'],
            'member_groups' => (array) $data['members_block']['member_groups'],
            'member_enterprises' => (array) $data['members_block']['member_enterprises'],
            'member_excludes' => (array) $data['members_block']['member_excludes'],
        ];

        if (isset($data['members_block']['access_date'])) {
            $membersBlock['access_date'] = (array) $data['members_block']['access_date'];
        }

        if (!isset($data['members_block']['access_date']) && isset($data['visible_block']['access_date'])) {
            $membersBlock['access_date'] = (array) $data['visible_block']['access_date'];
        }
        unset($data['members_block']);

        return array_merge($data, $membersBlock);
    }
}

