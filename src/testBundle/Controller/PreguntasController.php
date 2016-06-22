<?php

namespace testBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use testBundle\Entity\Preguntas;
use testBundle\Form\PreguntasType;
use testBundle\Entity\Opciones;
use testBundle\Form\OpcionesType;

/**
 * Preguntas controller.
 *
 */
class PreguntasController extends Controller
{

    /**
     * Lists all Preguntas entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('testBundle:Preguntas')->findAll();

        return $this->render('testBundle:Preguntas:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Preguntas entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Preguntas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        #echo "<pre>";
        #print_r($request);
        #echo "</pre>";
        #die();


        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            foreach ($entity->getOpciones() as $key ) {
                $opcionEntity=new Opciones();
                $opcion = $key->getOpcion();
                $valor = $key->getValor();
                $opcionEntity->setPregunta($entity);
                $opcionEntity->setOpcion($opcion);
                $opcionEntity->setValor($valor);
                $em->persist($opcionEntity);
                $em->flush();
            }


            return $this->redirect($this->generateUrl('preguntas_show', array('id' => $entity->getId())));
        }

        return $this->render('testBundle:Preguntas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Preguntas entity.
     *
     * @param Preguntas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Preguntas $entity)
    {
        $form = $this->createForm(new PreguntasType(), $entity, array(
            'action' => $this->generateUrl('preguntas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Preguntas entity.
     *
     */
    public function newAction()
    {
        $entity = new Preguntas();
        $form   = $this->createCreateForm($entity);

        return $this->render('testBundle:Preguntas:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Preguntas entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Preguntas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:Preguntas:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Preguntas entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Preguntas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntas entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:Preguntas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Preguntas entity.
    *
    * @param Preguntas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Preguntas $entity)
    {
        $form = $this->createForm(new PreguntasType(), $entity, array(
            'action' => $this->generateUrl('preguntas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Preguntas entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Preguntas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('preguntas_edit', array('id' => $id)));
        }

        return $this->render('testBundle:Preguntas:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Preguntas entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('testBundle:Preguntas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Preguntas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('preguntas'));
    }

    /**
     * Creates a form to delete a Preguntas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('preguntas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
