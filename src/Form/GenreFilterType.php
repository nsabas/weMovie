<?php

namespace App\Form;

use App\API\RequestManager;
use App\Model\GenericItemModel;
use App\Model\Genre\GenreModel;
use App\ServicePath\GenreRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenreFilterType extends AbstractType
{
    /**
     * @var RequestManager
     */
    private RequestManager $requestManager;

    /**
     * @var GenericItemModel[]
     */
    private array $genres;

    /**
     * @param RequestManager $requestManager
     */
    public function __construct(
        RequestManager $requestManager
    )
    {
        $this->genres = $requestManager->getResource(GenreRequest::GET_GENRES_LIST, [], [], true)->genres;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_GET)
            ->add('genres', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'choices' => $this->genres,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('filter', SubmitType::class, [ 'label' => 'Filtrer' ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GenreModel::class
        ]);
    }


}
