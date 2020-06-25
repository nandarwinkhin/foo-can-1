<?php

namespace App\Components\CardType\Repositories;

use App\Components\Core\BaseRepository;
use App\Components\Core\Utilities\Helpers;
use App\Components\CardType\Models\CardType;


class CardTypeRepository extends BaseRepository
{
    public function __construct(CardType $model)
    {
        parent::__construct($model);
    }

    /**
     * list all users
     *
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed[]
     */
    public function listCardTypes($params)
    {
        return $this->get($params,['groups'],function($q) use ($params)
        {
            $q->ofGroups(Helpers::commasToArray($params['group_id'] ?? ''));
            $q->ofcardTypeName($params['cardTypeName'] ?? '');
            $q->ofcardTypeDescription($params['cardTypeDescription'] ?? '');

            return $q;
        });
    }

    /**
     * index items
     *
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model[]|\Illuminate\Support\Collection
     */
    // public function index($params)
    // {
    //     return $this->get($params,[],function($q) use ($params)
    //     {
    //         $cardTypeName = Arr::get($params,'cardTypeName','');

    //         $q->where('cardTypeName','like',"%{$cardTypeName}%");

    //         return $q;
    //     });
    // }
}