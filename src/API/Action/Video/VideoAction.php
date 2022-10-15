<?php

namespace App\API\Action\Video;

use App\API\RequestManager;
use App\Model\Video\VideoItemModel;
use App\Model\Video\VideoModel;
use App\ServicePath\VideoRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoAction
{

    const VIDEO_ADAPTEUR_LINK = [
        'YouTube' => VideoRequest::ABSOLUT_EMBEDDED_YOUTUBE_VIDEO,
    ];

    private RequestManager $requestManager;

    public function __construct(
        RequestManager $requestManager
    )
    {
        $this->requestManager = $requestManager;
    }


    /**
     *
     * @Route("/api/video/{movieId}", name="video_details_movie", methods={"GET"})
     *
     */
    public function __invoke(int $movieId)
    {
        try {
            /** @var VideoModel $videos */
            $videos = $this->requestManager->getResource(
                VideoRequest::GET_VIDEO_DETAILS,
                [],
                [
                    '{movie_id}' => $movieId
                ]
            );

            /** @var VideoItemModel $result */
            $result = $videos->results[0];

            if(!array_key_exists($result->site, self::VIDEO_ADAPTEUR_LINK)) {
                return new JsonResponse('error', Response::HTTP_BAD_REQUEST);
            }

            $path =  $this->requestManager->resolvePath(
                self::VIDEO_ADAPTEUR_LINK[$result->site],
                [
                    '{key}' => $result->key
                ]
            );

            return new JsonResponse([
                'link' => $path
            ]);
        } catch (\Exception $exception){
            return new JsonResponse(['message' => 'error'], Response::HTTP_BAD_REQUEST);
        }
    }


}
