<?php

namespace Curso\PruebaDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Curso\PruebaDoctrineBundle\Entity\CursoArticulo;

/**
 * CursoArticulo controller.
 *
 */
class CursoArticuloController extends Controller
{
    /**
     * Lists all CursoArticulo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CursoPruebaDoctrineBundle:CursoArticulo')->findAll();

        return $this->render('CursoPruebaDoctrineBundle:CursoArticulo:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CursoArticulo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CursoPruebaDoctrineBundle:CursoArticulo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CursoArticulo entity.');
        }

        return $this->render('CursoPruebaDoctrineBundle:CursoArticulo:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

}
