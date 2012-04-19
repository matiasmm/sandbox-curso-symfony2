<?php

namespace Curso\PruebaDoctrineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Symfony\Component\Validator\Constraints\MinLength;
use Symfony\Component\Validator\Constraints\Collection;

class CursoArticuloType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descripcion', 'textarea')
//            ->add('deletedAt')
        ;
    }

    public function getName()
    {
        return 'business_articulo';
    }
    
    public function getDefaultOptions()
    {
        $collectionConstraint = new Collection(array(
            'titulo' => new MinLength(5),
            'descripcion' => new MinLength(5),
        ));

        return array('validation_constraint' => $collectionConstraint);
    }
    
}
