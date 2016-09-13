<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Method("GET")
     * @Route("/users", name="get_users")
     * @return Response
     */
    public function getUsersAction() {
        $em   = $this->getDoctrine()->getManager();
        $data = $em->getRepository( 'AppBundle:User' )->findAll();
        $serializer = $this->container->get('jms_serializer');
        return new Response($serializer->serialize($data,'json'),200,array('Content-type'=>'application/json'));
    }

    /**
     * @Method("GET")
     * @Route("/user/{user}", name="get_user")
     * @param User $user
     * @return Response
     */
    public function getUserAction(User $user) {

        $serializer = $this->container->get('jms_serializer');
        return new Response($serializer->serialize($user,'json'),200,array('Content-type'=>'application/json'));
    }

    /**
     * @Method("PUT")
     * @Route("/user/{user}", name="put_user")
     * @param User $user
     * @return Response
     */
    public function putUserAction(User $user) {
        $em = $this->getDoctrine()->getManager();
        $user->setAddress('24th Avenue');
        $em->flush();
        $serializer = $this->container->get('jms_serializer');

        return new Response($serializer->serialize($user,'json'),200,array('Content-type'=>'application/json'));
    }
}