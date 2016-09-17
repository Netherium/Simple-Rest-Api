<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;

use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends BaseController implements ClassResourceInterface {
	/**
	 * @View(serializerGroups={"admin", "Default" })
	 */
	public function cgetAction() {
		$em = $this->getDoctrine()->getManager();

		return $em->getRepository( 'AppBundle:User' )->findAll();
	}

	/**
	 * Gets an individual User
	 *
	 * @param int $id
	 * @View(serializerGroups={"Default"})
	 *
	 * @throws \Doctrine\ORM\NoResultException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 * @return mixed
	 */
	public function getAction( $id ) {
		$user = $this->getDoctrine()->getRepository( 'AppBundle:User' )->find( $id );
		if ( $user === null ) {
			return $this->responseCodeView(Response::HTTP_INTERNAL_SERVER_ERROR);
		}
		return $user;
	}

	/**
	 * @View(serializerGroups={"Default"})
	 *
	 * @return mixed
	 */
	public function postAction( Request $request ) {
		$serializer = $this->get( 'serializer' );

		/**
		 * @var $newUser User
		 */
		$newUser    = $serializer->deserialize( $request->getContent(), User::class, $request->get('_format') );
		$em         = $this->getDoctrine()->getManager();
		$em->persist( $newUser );
		$em->flush();
		$routeOptions = [
			'id' => $newUser->getId(),
			'_format' => $request->get('_format'),
		];
		$view = $this->routeRedirectView('get_users', $routeOptions, Response::HTTP_CREATED);
		$view->setData(array('id' => $newUser->getId()));
		return $view;
	}

//    /**
//     * @Method("GET")
//     * @Route("/users", name="get_users")
//     * @return Response
//     */
//    public function getUsersAction() {
//        $em   = $this->getDoctrine()->getManager();
//        $data = $em->getRepository( 'AppBundle:User' )->findAll();
//        $serializer = $this->container->get('jms_serializer');
//        return new Response($serializer->serialize($data,'json'),200,array('Content-type'=>'application/json'));
//    }
//
//    /**
//     * @Method("GET")
//     * @Route("/user/{user}", name="get_user")
//     * @param User $user
//     * @return Response
//     */
//    public function getUserAction(User $user) {
//
//        $serializer = $this->container->get('jms_serializer');
//        return new Response($serializer->serialize($user,'json'),200,array('Content-type'=>'application/json'));
//    }
//
//    /**
//     * @Method("PUT")
//     * @Route("/post_user/{id}", name="put_user", requirements={"id": "\d+"})
//     * @param User $user
//     * @return Response
//     */
//    public function putUserAction($id, Request $request) {
////        $em = $this->getDoctrine()->getManager();
////        $user->setAddress('24th Avenue');
////        $em->flush();
////	    $em    = $this->getDoctrine()->getManager();
////	    $motto = $em->getRepository( 'AppBundle:User' )->find( $object );
//        $serializer = $this->container->get('jms_serializer');
//	    $temp = $request->getContent();
////		$temp = $serializer->serialize($request->request->all(), 'json');
//	    $temp = $serializer->fromArray($request->request->all(), User::class);
//        return new Response();
//    }
}