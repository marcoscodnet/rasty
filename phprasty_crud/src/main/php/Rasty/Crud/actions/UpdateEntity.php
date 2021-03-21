<?php
namespace Rasty\Crud\actions;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de una entity.
 * 
 * @author Bernardo
 * @since 12/08/2015
 */
abstract class UpdateEntity extends Action{

	protected abstract function getFromPageName();

	protected abstract function getEntityService();
	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build( $this->getFromPageName() );
		
		$entityForm = $page->getForm();
			
		$oid = $entityForm->getOid();
						
		try {

			//obtenemos la entity.
			$entity = $this->getEntityService()->get( $oid );
		
			//lo editamos con los datos del formulario.
			$entityForm->fillEntity($entity);
			
			//guardamos los cambios.
			$this->getEntityService()->update( $entity );
			
			$forward->setPageName( $entityForm->getBackToOnSuccess() );
			$this->addForwardParams($forward, $entity);
			
			$entityForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( $this->getFromPageName() );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
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