<?php

namespace App\ServicePath;

use App\API\RequestManager;
use App\Model\Video\VideoModel;
use Symfony\Component\HttpFoundation\Request;

class VideoRequest
{

    /**
     *
     */
    const GET_VIDEO_DETAILS = [
        RequestManager::METHOD => Request::METHOD_GET,
        RequestManager::PATH => '/3/movie/{movie_id}/videos',
        RequestManager::MODEL => VideoModel::class
    ];

    /**
     *
     */
    const ABSOLUT_EMBEDDED_YOUTUBE_VIDEO = [
        RequestManager::METHOD => Request::METHOD_GET,
        RequestManager::PATH => 'https://www.youtube.com/embed/{key}?controls=0',
    ];
}
