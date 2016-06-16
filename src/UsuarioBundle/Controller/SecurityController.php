<?php
namespace UsuarioBundle\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use UsuarioBundle\Entity\Usuario;
use UsuarioBundle\Form\UsuarioType;
 
class SecurityController extends Controller
{
    public function loginAction()
    {
    


        //Instanciar clase usuario para meter registro en el login
        $entity = new Usuario();
        $form   = $this->createCreateForm($entity);

        $request = $this->getRequest();
        $session = $request->getSession();
 
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
         $em = $this->getDoctrine()->getManager();

            return $this->render('UsuarioBundle:Security:login.html.twig',
                array(
                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                    'error'         => $error,
                    'entity' => $entity,
                    'form'   => $form->createView(),
                ));
    }
    private function createCreateForm(Usuario $entity)
    {
        $form = $this->createForm(new UsuarioType(), $entity, array(
            'action' => $this->generateUrl('usuario_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Registrar','attr' => array( 'class' => 'reg btn btn-lg col-md-6 btn-primary ')));

        return $form;
    }


}