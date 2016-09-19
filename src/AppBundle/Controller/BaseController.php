<?php
namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends FOSRestController {
	/**
	 * @param int $httpResponseCode
	 *
	 * @return \FOS\RestBundle\View\View
	 */
	public function responseCodeView( $httpResponseCode ) {
		return $this->view( array(
			"code"    => $httpResponseCode,
			"message" => Response::$statusTexts[ $httpResponseCode ]
		), $httpResponseCode );
	}
}