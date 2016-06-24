<?php

namespace testBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use testBundle\Entity\SetRespuestas;
use testBundle\Form\SetRespuestasType;

/**
 * SetRespuestas controller.
 *
 */
class SetRespuestasController extends Controller
{

    /**
     * Lists all SetRespuestas entities.
     *
     */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('testBundle:Test')->find($id);
        $setRespuestas = $em->getRepository('testBundle:SetRespuestas')->findBy(array('test'=>$test));
        foreach ($setRespuestas as $s ) {
        echo "<pre>";
        $opciones =  $em->getRepository('testBundle:Opciones')->find($s->getOpcion()->getId());

        print_r($opciones->getPregunta()->getRespuestaCorrecta());
        print_r($opciones->getPregunta()->getId());
        print_r($opciones->getValor());
        //var_dump($s->getOpcion()->getOpcion());

        echo "</pre>";
            
        }
        die();



        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SetRespuestas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:SetRespuestas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
                ));
    }
    /**
     * Creates a new SetRespuestas entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SetRespuestas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('setrespuestas_show', array('id' => $entity->getId())));
        }

        return $this->render('testBundle:SetRespuestas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SetRespuestas entity.
     *
     * @param SetRespuestas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SetRespuestas $entity)
    {
        $form = $this->createForm(new SetRespuestasType(), $entity, array(
            'action' => $this->generateUrl('setrespuestas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SetRespuestas entity.
     *
     */
    public function newAction()
    {
        $entity = new SetRespuestas();
        $form   = $this->createCreateForm($entity);

        return $this->render('testBundle:SetRespuestas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SetRespuestas entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:SetRespuestas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SetRespuestas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:SetRespuestas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SetRespuestas entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:SetRespuestas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SetRespuestas entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:SetRespuestas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SetRespuestas entity.
    *
    * @param SetRespuestas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SetRespuestas $entity)
    {
        $form = $this->createForm(new SetRespuestasType(), $entity, array(
            'action' => $this->generateUrl('setrespuestas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SetRespuestas entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:SetRespuestas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SetRespuestas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('setrespuestas_edit', array('id' => $id)));
        }

        return $this->render('testBundle:SetRespuestas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SetRespuestas entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('testBundle:SetRespuestas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SetRespuestas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('setrespuestas'));
    }

    /**
     * Creates a form to delete a SetRespuestas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('setrespuestas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
