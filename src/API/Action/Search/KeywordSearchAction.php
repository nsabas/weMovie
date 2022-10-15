<?php

namespace App\API\Action\Search;

use App\API\RequestManager;
use App\ServicePath\SearchKeywordRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class KeywordSearchAction
 * @package App\API\Action\Search
 * @author Nicolas SABAS <nicolassabas.freelance@gmail.com>
 */
class KeywordSearchAction
{
    /**
     * @var RequestManager
     */
    private RequestManager $requestManager;
    private NormalizerInterface $normalizer;

    /**
     * @param RequestManager $requestManager
     */
    public function __construct(
        RequestManager $requestManager,
        NormalizerInterface $normalizer
    )
    {
        $this->requestManager = $requestManager;
        $this->normalizer = $normalizer;
    }


    /**
     * @param string $keyword
     * @return JsonResponse
     *
     * @Route("/api/search/autocomplete/{keyword}", name="search_autocomplete", methods={"GET"})
     *
     */
    public function __invoke(string $keyword)
    {
        $searchResult = $this->requestManager->getResource(
            SearchKeywordRequest::SEARCH_KEYWORD,
            [
                'query' => [ 'query' => $keyword ]
            ]
        );


        return new JsonResponse($this->normalizer->normalize($searchResult));
    }


}
