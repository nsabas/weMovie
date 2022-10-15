<?php

namespace App\API\Action\Image;

use App\API\RequestManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageAction
{

    private RequestManager $requestManager;

    public function __construct(
        RequestManager $requestManager
    )
    {
        $this->requestManager = $requestManager;
    }


    /**
     * @return Response
     *
     * @Route("/api/image/{name}/{size}", name="image_render", methods={"GET"})
     *
     */
    public function __invoke(string $name, string $size)
    {
        return new Response($this->requestManager->getImage($name, $size)->getContent(), Response::HTTP_OK, [ 'Content-Type' => 'image/jpeg' ]);
    }


}
