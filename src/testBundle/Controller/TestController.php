<?php

namespace testBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use testBundle\Entity\Test;
use testBundle\Form\TestType;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Form\UsuarioType;


use testBundle\Entity\SetRespuestas;
use testBundle\Form\SetRespuestasType;

/**
 * Test controller.
 *
 */
class TestController extends Controller
{

    /**
     * Lists all Test entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('testBundle:Test')->findAll();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        #echo "<pre>";
        #print_r($user);
        #echo "</pre>";
        #die();
        return $this->render('testBundle:Test:index.html.twig', array(
            'entities' => $entities,
            'user'     => $user,
        ));
    }
    /**
     * Creates a new Test entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Test();
        $usuario = new Usuario();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->get('doctrine.orm.default_entity_manager');
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            //echo "<pre>";
            //print_r($this->getUser());
            //echo "</pre>";
            //die();


            $entity->setFechaInicio(new \DateTime('now'));
            $entity->setEstatus('Abierto');
            $entity->setUsuario($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('test_show', array('id' => $entity->getId())));
        }

        return $this->render('testBundle:Test:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Test entity.
     *
     * @param Test $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Test $entity)
    {
        $form = $this->createForm(new TestType(), $entity, array(
            'action' => $this->generateUrl('test_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Test entity.
     *
     */
    public function newAction()
    {
        $entity = new Test();
        $form   = $this->createCreateForm($entity);
        $form->add('submit','submit', array(
            'label' => 'Iniciar',
            'attr'  => array('class' => 'btn btn-block btn-lg btn-default btn-warning ')
        ));

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        $areas = $em->getRepository('AreasBundle:Area')->findAll();
        $subarea = $em->getRepository('AreasBundle:SubArea')->findAll();
        $reactivos = $em->getRepository('AreasBundle:Reactivos')->findAll();

        return $this->render('testBundle:Test:new.html.twig', array(
            'reactivos' => $reactivos,
            'subareas' => $subarea,
            'areas' => $areas,
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }



    public function realizadosAction()
    {
        $em = $this->getDoctrine()->getManager();


        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $preguntas = $em->getRepository('testBundle:Preguntas')->findAll();
        $testUser = $em->getRepository('testBundle:Test')->findBy(array('usuario'=>$user));
        $allTest = [];
        foreach ($testUser as $test ) {
            $allTest[] = $test;
        }

        return $this->render('testBundle:Test:misExamenes.html.twig', array(
            'allTest'      => $allTest,
        ));
    }







    /**
     * Finds and displays a Test entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('testBundle:Test')->find($id);


        if (!$test) {
            throw $this->createNotFoundException('Unable to find Test test.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $preguntas = $em->getRepository('testBundle:Preguntas')->findAll();
        foreach ($preguntas as $pregunta ) {
            $opciones[] = $em->getRepository('testBundle:Opciones')->findBy(array(
                'pregunta' => $pregunta->getId()));
        }

        $insiso = ['a','b','c','d'];
        $area = $em->getRepository('AreasBundle:Area')->findAll();
        $subarea = $em->getRepository('AreasBundle:SubArea')->findAll();
        return $this->render('testBundle:Test:examen.html.twig', array(
            'preguntas'  => $preguntas,
            'opciones'      => $opciones,
            'area'      => $area,
            'subarea'      => $subarea,
            'insiso'      => $insiso,
            'test'      => $test,
        ));
    }

    /**
     * Displays a form to edit an existing Test entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('testBundle:Test:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Test entity.
    *
    * @param Test $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Test $entity)
    {
        $form = $this->createForm(new TestType(), $entity, array(
            'action' => $this->generateUrl('test_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Test entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }


        //
        //RECORRE EL REQUEST Y BUSA LA OPCION POR EL ID
        //DEPUES INSERTA EN LA ENTIDAD DE SET DE RESPUESTAS
        //
    
        $entity->setEstatus('Terminado');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $opciones = $this->getRequest()->request->all();
        $cont = 0;
        foreach ($opciones as $opcion) {
            $cont++;
            $setRespuestas = new SetRespuestas();
            $entityOpcion = $em->getRepository('testBundle:Opciones')->find($opcion);
            $setRespuestas->setTest($entity);
            $setRespuestas->setOpcion($entityOpcion);
            $em->persist($setRespuestas);
            $em->flush();

        }
    


               return $this->redirect($this->generateUrl('usuario'));

    }





    public function keepTestAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('testBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        echo "CONTINUAR TEST";

        //
        //RECORRE EL REQUEST Y BUSA LA OPCION POR EL ID
        //DEPUES INSERTA EN LA ENTIDAD DE SET DE RESPUESTAS
        //
        die();
    
        $entity->setEstatus('Realizando');
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $opciones = $this->getRequest()->request->all();
        $cont = 0;
        foreach ($opciones as $opcion) {
            $cont++;
            $setRespuestas = new SetRespuestas();
            $entityOpcion = $em->getRepository('testBundle:Opciones')->find($opcion);
            $setRespuestas->setTest($entity);
            $setRespuestas->setOpcion($entityOpcion);
            $em->persist($setRespuestas);
            $em->flush();

        }
    


               return $this->redirect($this->generateUrl('usuario'));

    }






    /**
     * Deletes a Test entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('testBundle:Test')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Test entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('test'));
    }

    /**
     * Creates a form to delete a Test entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('test_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
