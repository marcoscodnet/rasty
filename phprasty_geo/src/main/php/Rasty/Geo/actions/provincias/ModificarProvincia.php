<?php
namespace Rasty\Geo\actions\provincias;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de una Provincia.
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class ModificarProvincia extends UpdateEntity{

	protected function getFromPageName(){
		
		return "ProvinciaUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIProvinciaService();
			
	}

	protected function addForwardParams($forward, $entity ){
		parent::addForwardParams($forward, $entity );
		$forward->addParam( "paisOid", $entity->getPais()->getOid() );
	}
}
?>