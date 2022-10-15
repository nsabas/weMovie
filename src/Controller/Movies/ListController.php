<?php

namespace App\Controller\Movies;

use App\API\RequestManager;
use App\Form\GenreFilterType;
use App\Model\GenericItemModel;
use App\Model\Genre\GenreModel;
use App\ServicePath\MovieRequest;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class ListController
{
    /**
     * @var Environment
     */
    private Environment $template;

    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formBuilder;

    /**
     * @var RequestManager
     */
    private RequestManager $requestManager;


    /**
     * @param FormFactoryInterface $formBuilder
     * @param Environment $template
     * @param RequestManager $requestManager
     */
    public function __construct(
        FormFactoryInterface $formBuilder,
        Environment $template,
        RequestManager $requestManager

    )
    {
        $this->template = $template;
        $this->formBuilder = $formBuilder;
        $this->requestManager = $requestManager;
    }

    /**
     *
     * @Route("/films",  name="home", methods={"GET", "POST"})
     */
    public function __invoke(Request $request): Response
    {
        $genresFilter = new GenreModel();
        $topTrendingMovies = $this->requestManager->getResource(
            MovieRequest::GET_MOVIE_TOP_TRENDING_WEEK,
            [
                'query' => [ 'page' => $request->get('page', 1) ],
            ]
        );
        $genreFilterForm = $this->formBuilder->create(GenreFilterType::class, $genresFilter);

        $genreFilterForm->handleRequest($request);

        if ($genreFilterForm->isSubmitted() && $genreFilterForm->isValid()) {
            $movies = $this->requestManager->getResource(
                MovieRequest::GET_MOVIE_LIST, [
                'query' => [
                    'with_genres' => implode(',', array_map(function (GenericItemModel $genre){
                        return $genre->id;
                    }, $genresFilter->genres)),
                    'page' => $request->get('page', 1)
                ],
            ]);
        } else {
            array_shift($topTrendingMovies->results);
            $movies = $topTrendingMovies;
        }

        return new Response(
            $this->template->render(
                'movies/list.html.twig',
                [
                    'genreFilterForm' => $genreFilterForm->createView(),
                    'movies' => $movies,
                    'topTrendingMovie' => $topTrendingMovies->results[0]
                ]
            )
        );
    }

}
