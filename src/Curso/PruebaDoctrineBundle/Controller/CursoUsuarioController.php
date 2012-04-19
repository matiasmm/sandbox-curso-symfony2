<?php

namespace Curso\PruebaDoctrineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Curso\PruebaDoctrineBundle\Entity\CursoUsuario;
use Curso\PruebaDoctrineBundle\Form\CursoUsuarioType;

/**
 * CursoUsuario controller.
 *
 */
class CursoUsuarioController extends Controller
{
    /**
     * Lists all CursoUsuario entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CursoPruebaDoctrineBundle:CursoUsuario')->findAll();

        return $this->render('CursoPruebaDoctrineBundle:CursoUsuario:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a CursoUsuario entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CursoPruebaDoctrineBundle:CursoUsuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CursoUsuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CursoPruebaDoctrineBundle:CursoUsuario:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new CursoUsuario entity.
     *
     */
    public function newAction()
    {
        $entity = new CursoUsuario();
        $form   = $this->createForm(new CursoUsuarioType(), $entity);

        return $this->render('CursoPruebaDoctrineBundle:CursoUsuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new CursoUsuario entity.
     *
     */
    public function createAction()
    {
        $entity  = new CursoUsuario();
        $request = $this->getRequest();
        $form    = $this->createForm(new CursoUsuarioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cursousuario_show', array('id' => $entity->getId())));
        }

        return $this->render('CursoPruebaDoctrineBundle:CursoUsuario:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CursoUsuario entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CursoPruebaDoctrineBundle:CursoUsuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CursoUsuario entity.');
        }

        $editForm = $this->createForm(new CursoUsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CursoPruebaDoctrineBundle:CursoUsuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing CursoUsuario entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CursoPruebaDoctrineBundle:CursoUsuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CursoUsuario entity.');
        }

        $editForm   = $this->createForm(new CursoUsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cursousuario_edit', array('id' => $id)));
        }

        return $this->render('CursoPruebaDoctrineBundle:CursoUsuario:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CursoUsuario entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CursoPruebaDoctrineBundle:CursoUsuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CursoUsuario entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cursousuario'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
