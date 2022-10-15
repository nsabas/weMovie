<?php

namespace App\ServicePath;

use App\API\RequestManager;
use App\Model\Movie\MovieModel;
use Symfony\Component\HttpFoundation\Request;

class SearchKeywordRequest
{
    const SEARCH_KEYWORD = [
        RequestManager::METHOD => Request::METHOD_GET,
        RequestManager::PATH => '/3/search/keyword',
        RequestManager::MODEL => MovieModel::class
    ];
}

