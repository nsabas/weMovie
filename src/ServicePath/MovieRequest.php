<?php

namespace App\ServicePath;

use App\API\RequestManager;
use App\Model\Movie\MovieModel;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MovieRequest
 * @package App\API\ServicePath
 * @author Nicolas SABAS <nicolassabas.freelance@gmail.com>
 */
class MovieRequest
{
    /**
     * Get all Movies by genre or other filter
     *
     */
    const GET_MOVIE_LIST = [
        RequestManager::METHOD => Request::METHOD_GET,
        RequestManager::PATH   => '/3/discover/movie',
        RequestManager::MODEL  => MovieModel::class
    ];

    /**
     * Get Movies top trending
     *
     */
    const GET_MOVIE_TOP_TRENDING_WEEK = [
        RequestManager::METHOD => Request::METHOD_GET,
        RequestManager::PATH   => '3/trending/movie/week',
        RequestManager::MODEL  => MovieModel::class
    ];
}
