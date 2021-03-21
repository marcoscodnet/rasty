<?php
namespace Rasty\Crud\actions;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la eliminación de una entity.
 * 
 * @author Bernardo
 * @since 12/08/2015
 */
abstract class DeleteEntity extends Action{

	protected abstract function getFromPageName();

	protected abstract function getEntityService();
	
	protected abstract function getToPageName();
	
	
	public function execute(){

		$forward = new Forward();
		
		$oid = RastyUtils::getParamPOST("oid");			
						
		try {

			$entity = $this->getEntityService()->get( $oid );
			
			//eliminamos la entity
			$this->getEntityService()->delete( $oid );
			
			$forward->setPageName( $this->getToPageName() );
			$this->addForwardParams($forward, $entity);
			
		} catch (RastyException $e) {
		
			$forward->setPageName( $this->getFromPageName() );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
		}
		
		return $forward;
		
	}
	
	protected function addForwardParams($forward, $entity ){
		$forward->addParam( "oid", $entity->getOid() );
	}
}
?>