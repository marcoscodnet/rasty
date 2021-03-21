<?php
namespace Rasty\app;


use Rasty\actions\Forward;

use Rasty\security\RastySecurityContext;
use Rasty\exception\UserRequiredException;
use Rasty\exception\UserPermissionException;

use Rasty\components\RastyPage;
use Rasty\components\RastyComponent;
use Rasty\actions\Action;
use Rasty\actions\JsonAction;

/**
 * Listener para chequear prerequisitos para ejecutar un componente.
 *
 * @author Bernardo
 * @since 27-03-2015
 */
class RequirementsRastyListener implements IApplicationListener {

	private $redirectPage="ErrorNoEsperado";
	
	/**
	 * se ejecuta una página
	 * @param $page
	 */
	function pageExecuted( RastyPage $page) {
	
		try {

			$page->checkRequirementsToPerform();
			
		} catch (Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			
		} catch (\Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
		}	
		
	}
	
	/**
	 * se ejecuta un componente
	 * @param $component
	 */
	function componentExecuted( RastyComponent $component) {
		
		try {

			$component->checkRequirementsToPerform();
				
		} catch (Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			
		} catch (\Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			header ( 'Location: '.  $forward->buildForwardUrl() );
		}
		
			
			
	}
	
	/**
	 * se ejecuta un action
	 * @param $action
	 */
	function actionExecuted( Action $action) {
	
		try {

			$action->checkRequirementsToPerform();
				
		} catch (Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			
		} catch (\Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			header ( 'Location: '.  $forward->buildForwardUrl() );
		}
	}
	
	/**
	 * se ejecuta un action json
	 * @param $action
	 */	
	function actionJsonExecuted( JsonAction $action) {
	
		try {

			$action->checkRequirementsToPerform();
				
		} catch (Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			
			header ( 'Location: '.  $forward->buildForwardUrl() );
			
		} catch (\Exception $e) {
			
			$forward = new Forward();
			$forward->setPageName( $this->getRedirectPage() );
			$forward->addError( $e->getMessage() );
			header ( 'Location: '.  $forward->buildForwardUrl() );
		}
	}    

	public function getRedirectPage()
	{
	    return $this->redirectPage;
	}

	public function setRedirectPage($redirectPage)
	{
	    $this->redirectPage = $redirectPage;
	}
}