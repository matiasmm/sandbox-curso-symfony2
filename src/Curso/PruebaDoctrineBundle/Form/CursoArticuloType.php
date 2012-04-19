<?php

namespace Curso\PruebaDoctrineBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

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
        return 'curso_pruebadoctrinebundle_cursoarticulotype';
    }
}
