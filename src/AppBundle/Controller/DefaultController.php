<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {
	/**
	 * @Method(methods={"GET"})
	 * @Route("/users", name="home")
	 */
	public function getUsersAction() {
		$em   = $this->getDoctrine()->getManager();
		$data = $em->getRepository( 'AppBundle:User' )->findAll();
		$serializer = $this->container->get('jms_serializer');
		return new Response($serializer->serialize($data,'json'),200,array('Content-type'=>'application/json'));
	}

	/**
	 * @Method(methods={"GET"})
	 * @Route("/user/{user}", name="get_user")
	 */
	public function getUserAction(User $user) {
//		$em   = $this->getDoctrine()->getManager();
//		$data = $em->getRepository( 'AppBundle:User' )->findAll();
		$serializer = $this->container->get('jms_serializer');
		return new Response($serializer->serialize($user,'json'),200,array('Content-type'=>'application/json'));
	}

	/**
	 * @Method(methods={"PUT"})
	 * @Route("/put/user/{user}", name="put_user")
	 * @param User $user
	 * @return Response
	 */
	public function putUserAction(User $user) {
		$em = $this->getDoctrine()->getManager();
		$user->setAddress('24th Avenue');
		$em->flush();
//		$em   = $this->getDoctrine()->getManager();
//		$data = $em->getRepository( 'AppBundle:User' )->findAll();
		$serializer = $this->container->get('jms_serializer');

		return new Response($serializer->serialize($user,'json'),200,array('Content-type'=>'application/json'));
	}
}
