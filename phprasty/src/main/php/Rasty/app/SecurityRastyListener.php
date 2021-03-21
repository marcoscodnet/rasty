<?php
namespace Rasty\app;


use Rasty\utils\Logger;

use Rasty\actions\Forward;

use Rasty\security\RastySecurityContext;
use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\components\RastyPage;
use Rasty\components\RastyComponent;
use Rasty\actions\Action;
use Rasty\actions\JsonAction;



/**
 * Listener de segurización de componentes.
 *
 * @author Bernardo
 * @since 17-03-2015
 */
class SecurityRastyListener implements IApplicationListener {

	private $unauthorizeRedirectPage="Login";

	/**
	 * se ejecuta una página
	 * @param $page
	 */
	function pageExecuted( RastyPage $page) {
	
		try {
			//Logger::log("executando page " . $page->getType(), __CLASS__);
			
			RastySecurityContext::authorize($page);
			
		} catch (UserRequiredException $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getUnauthorizeRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			exit(0);
			
		} catch (UserPermissionException $e) {
			Logger::log("NO TIENE AUTORIZACION", __CLASS__);
			
			$forward = new Forward();
			$forward->setPageName( $this->getUnauthorizeRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			exit(0);
		}
	}
	
	/**
	 * se ejecuta un componente
	 * @param $component
	 */
	function componentExecuted( RastyComponent $component) {
		
		try {

			RastySecurityContext::authorizeComponent($component);
				
		} catch (UserRequiredException $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getUnauthorizeRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			exit(0);
		
		} catch (UserPermissionException $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getUnauthorizeRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			exit(0);
		}
			
			
	}
	
	/**
	 * se ejecuta un action
	 * @param $action
	 */
	function actionExecuted( Action $action) {

		try {

			RastySecurityContext::authorizeAction($action);
			
		} catch (UserRequiredException $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getUnauthorizeRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			exit(0);
			
		} catch (UserPermissionException $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getUnauthorizeRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			exit(0);
		}
			
	}
	
	/**
	 * se ejecuta un action json
	 * @param $action
	 */	
	function actionJsonExecuted( JsonAction $action) {
	
	}    

	public function getUnauthorizeRedirectPage()
	{
	    return $this->unauthorizeRedirectPage;
	}

	public function setUnauthorizeRedirectPage($unauthorizeRedirectPage)
	{
	    $this->unauthorizeRedirectPage = $unauthorizeRedirectPage;
	}
}