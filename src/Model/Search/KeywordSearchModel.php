<?php

namespace App\Model\Search;

use App\Model\GenericItemModel;
use App\Model\PagingatorModel;

class KeywordSearchModel
{

    use PagingatorModel;

    /**
     * @var GenericItemModel[]
     */
    public array $results;
}
