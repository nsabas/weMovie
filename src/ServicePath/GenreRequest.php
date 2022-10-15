<?php

namespace App\ServicePath;

use App\API\RequestManager;
use App\Model\Genre\GenreModel;
use Symfony\Component\HttpFoundation\Request;

class GenreRequest
{
    /**
     * Get all genres
     */
    const GET_GENRES_LIST = [
        RequestManager::METHOD => Request::METHOD_GET,
        RequestManager::PATH   => '/3/genre/movie/list',
        RequestManager::MODEL  => GenreModel::class,
    ];
}
