<?php

namespace App\Model\Movie;

use App\Model\GenericItemModel;

class MovieItemModelModel extends GenericItemModel
{
    public ?string $posterPath;
    public ?string $overview;
    public string $title;
    public float $popularity;
    public int $voteCount;
    public $voteAverage;

}
