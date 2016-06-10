<?php

namespace testBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use testBundle\Entity\Opciones;
use testBundle\Form\OpcionesType;

/**
 * Opciones controller.
 *
 */
class OpcionesController extends Controller
{

    /**
     * Lists all Opciones entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('testBundle:Opciones')->findAll();

        return $this->render('testBundle:Opciones:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Opciones entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Opciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('opciones_show', array('id' => $entity->getId())));
        }

        return $this->render('testBundle:Opciones:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Opciones entity.
     *
     * @param Opciones $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Opciones $entity)
    {
        $form = $this->createForm(new OpcionesType(), $entity, array(
            'action' => $this->generateUrl('opciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Opciones entity.
     *
     */
    public function newAction()
    {
        $entity = new Opciones();
        $form   = $this->createCreateForm($entity);

        return $this->render('testBundle:Opciones:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Opciones entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Opciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:Opciones:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Opciones entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Opciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:Opciones:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Opciones entity.
    *
    * @param Opciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Opciones $entity)
    {
        $form = $this->createForm(new OpcionesType(), $entity, array(
            'action' => $this->generateUrl('opciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Opciones entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Opciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Opciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('opciones_edit', array('id' => $id)));
        }

        return $this->render('testBundle:Opciones:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Opciones entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('testBundle:Opciones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Opciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('opciones'));
    }

    /**
     * Creates a form to delete a Opciones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('opciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
