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


    public function returnPDFResponseFromHTML($html){
        //set_time_limit(30); uncomment this line according to your needs
        // If you are not in a controller, retrieve of some way the service container and then retrieve it
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //if you are in a controlller use :
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('simualdor egel');
        $pdf->SetTitle(('calificaciones'));
        $pdf->SetSubject('simualdoregel');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        //$pdf->SetMargins(20,20,40, true);
        $pdf->AddPage();
        
        $filename = 'ourcodeworld_pdf_demo';
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly
    }


    public function renderPdfAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('testBundle:Test')->find($id);
        $test_id = $test->getId();
        $setRespuestas = $em->getRepository('testBundle:SetRespuestas')->findBy(array('test'=>$test));
        $opciones = [];
        $rescorrectas = 0;
        $total        = 0;
        $cont     = 0;
        foreach ($setRespuestas as $s ) {
        $setRes =  $em->getRepository('testBundle:Opciones')->find($s->getOpcion()->getId());
        $opciones[$cont]["pregunta"]        = $setRes->getPregunta()->getPregunta();
        $opciones[$cont]["correcta"]        = $setRes->getPregunta()->getRespuestaCorrecta();
        $opciones[$cont]["respuesta"]       = $setRes->getValor(); 
        $opciones[$cont]["respuestaopcion"]= $s->getOpcion()->getOpcion(); 
        $total += 1; 
        if($opciones[$cont]["correcta"] == $opciones[$cont]["respuesta"]){
            $rescorrectas += 1;
        }
        $cont++;           
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        





         $html = $this->render('testBundle:Test:pdf.html.twig', array(
            'opciones'      => $opciones,
            'rescorrectas'  => $rescorrectas,
            'total'         => $total,
            'usuario'       => $user,
                ));

        $this->returnPDFResponseFromHTML($html);


    }






    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('testBundle:Test')->find($id);
        $test_id = $test->getId();
        $setRespuestas = $em->getRepository('testBundle:SetRespuestas')->findBy(array('test'=>$test));
        $opciones = [];
        $rescorrectas = 0;
        $total        = 0;
        $cont     = 0;
        foreach ($setRespuestas as $s ) {
        $setRes =  $em->getRepository('testBundle:Opciones')->find($s->getOpcion()->getId());
        $opciones[$cont]["pregunta"]        = $setRes->getPregunta()->getPregunta();
        $opciones[$cont]["correcta"]        = $setRes->getPregunta()->getRespuestaCorrecta();
        $opciones[$cont]["respuesta"]       = $setRes->getValor(); 
        $opciones[$cont]["respuestaopcion"]= $s->getOpcion()->getOpcion(); 
        $total += 1; 
        if($opciones[$cont]["correcta"] == $opciones[$cont]["respuesta"]){
            $rescorrectas += 1;
        }
        $cont++;           
        }
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        if(!$test->getFechaFin()){
            $calificacion = ($rescorrectas * 10)/$total;
            $test->setCalificacion($calificacion);
            $fecha = new \DateTime();
            $test->setFechaFin($fecha);
            $em->flush();
        }

        return $this->render('testBundle:SetRespuestas:show.html.twig', array(
            'id_test'       => $test_id,
            'opciones'      => $opciones,
            'rescorrectas'  => $rescorrectas,
            'total'         => $total,
            'usuario'       => $user,
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
