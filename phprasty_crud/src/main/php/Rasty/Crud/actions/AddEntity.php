<?php
namespace Rasty\Crud\actions;


use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una entity.
 * 
 * @author Bernardo
 * @since 12/08/2015
 */
abstract class AddEntity extends Action{

	protected abstract function getFromPageName();
	protected abstract function getEntityInstance();
	protected abstract function getEntityService();
	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build( $this->getFromPageName() );
		
		$entityForm = $page->getForm();
		
		try {

			//creamos un nuevo Banco.
			$entity = $this->getEntityInstance();
			
			//completados con los datos del formulario.
			$entityForm->fillEntity($entity);
			
			//agregamos el Banco.
			$this->getEntityService()->add( $entity );
			
			$forward->setPageName( $entityForm->getBackToOnSuccess() );
			
			$this->addForwardParams($forward, $entity);
		
			$entityForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( $this->getFromPageName() );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$entityForm->save();
		}
		
		return $forward;
		
	}

	protected function addForwardParams($forward, $entity ){
		$forward->addParam( "oid", $entity->getOid() );
	}
}
?>