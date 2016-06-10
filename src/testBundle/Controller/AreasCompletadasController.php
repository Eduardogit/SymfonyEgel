<?php

namespace testBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use testBundle\Entity\AreasCompletadas;
use testBundle\Form\AreasCompletadasType;

/**
 * AreasCompletadas controller.
 *
 */
class AreasCompletadasController extends Controller
{

    /**
     * Lists all AreasCompletadas entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('testBundle:AreasCompletadas')->findAll();

        return $this->render('testBundle:AreasCompletadas:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AreasCompletadas entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AreasCompletadas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('areascompletadas_show', array('id' => $entity->getId())));
        }

        return $this->render('testBundle:AreasCompletadas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a AreasCompletadas entity.
     *
     * @param AreasCompletadas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AreasCompletadas $entity)
    {
        $form = $this->createForm(new AreasCompletadasType(), $entity, array(
            'action' => $this->generateUrl('areascompletadas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AreasCompletadas entity.
     *
     */
    public function newAction()
    {
        $entity = new AreasCompletadas();
        $form   = $this->createCreateForm($entity);

        return $this->render('testBundle:AreasCompletadas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AreasCompletadas entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:AreasCompletadas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AreasCompletadas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:AreasCompletadas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing AreasCompletadas entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:AreasCompletadas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AreasCompletadas entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:AreasCompletadas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AreasCompletadas entity.
    *
    * @param AreasCompletadas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AreasCompletadas $entity)
    {
        $form = $this->createForm(new AreasCompletadasType(), $entity, array(
            'action' => $this->generateUrl('areascompletadas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AreasCompletadas entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:AreasCompletadas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AreasCompletadas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('areascompletadas_edit', array('id' => $id)));
        }

        return $this->render('testBundle:AreasCompletadas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AreasCompletadas entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('testBundle:AreasCompletadas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AreasCompletadas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('areascompletadas'));
    }

    /**
     * Creates a form to delete a AreasCompletadas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('areascompletadas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
