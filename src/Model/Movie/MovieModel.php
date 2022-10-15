<?php

namespace App\Model\Movie;

use App\Model\PagingatorModel;

class MovieModel
{
    use PagingatorModel;

    /**
     * @var MovieItemModelModel[]
     */
    public array $results;
}
