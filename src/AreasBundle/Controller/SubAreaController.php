<?php

namespace AreasBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AreasBundle\Entity\SubArea;
use AreasBundle\Form\SubAreaType;

/**
 * SubArea controller.
 *
 */
class SubAreaController extends Controller
{

    /**
     * Lists all SubArea entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AreasBundle:SubArea')->findAll();
//        echo "<pre>";
//        print_r($entities);
//        echo "</pre>";
//        die();

        return $this->render('AreasBundle:SubArea:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new SubArea entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new SubArea();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subarea_show', array('id' => $entity->getId())));
        }

        return $this->render('AreasBundle:SubArea:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SubArea entity.
     *
     * @param SubArea $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SubArea $entity)
    {
        $form = $this->createForm(new SubAreaType(), $entity, array(
            'action' => $this->generateUrl('subarea_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SubArea entity.
     *
     */
    public function newAction()
    {
        $entity = new SubArea();
        $form   = $this->createCreateForm($entity);

        return $this->render('AreasBundle:SubArea:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SubArea entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AreasBundle:SubArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubArea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AreasBundle:SubArea:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SubArea entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AreasBundle:SubArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubArea entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AreasBundle:SubArea:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a SubArea entity.
    *
    * @param SubArea $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SubArea $entity)
    {
        $form = $this->createForm(new SubAreaType(), $entity, array(
            'action' => $this->generateUrl('subarea_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing SubArea entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AreasBundle:SubArea')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SubArea entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('subarea_edit', array('id' => $id)));
        }

        return $this->render('AreasBundle:SubArea:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a SubArea entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AreasBundle:SubArea')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SubArea entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subarea'));
    }

    /**
     * Creates a form to delete a SubArea entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subarea_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
