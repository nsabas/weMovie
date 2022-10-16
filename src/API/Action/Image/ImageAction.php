<?php

namespace App\API\Action\Image;

use App\API\RequestManager;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class ImageAction
 * @package App\API\Action\Image
 * @author Nicolas SABAS <nicolassabas.freelance@gmail.com>
 */
class ImageAction
{

    /**
     * @var RequestManager
     */
    private RequestManager $requestManager;

    /**
     * @param RequestManager $requestManager
     */
    public function __construct(
        RequestManager $requestManager
    )
    {
        $this->requestManager = $requestManager;
    }


    /**
     * @param string $name
     * @param string $size
     * @return Response
     *
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     *
     * @Route("/api/image/{name}/{size}", name="image_render", methods={"GET"})
     *
     */
    public function __invoke(string $name, string $size)
    {
        return new Response($this->requestManager->getImage($name, $size)->getContent(), Response::HTTP_OK, [ 'Content-Type' => 'image/jpeg' ]);
    }


}
