<?php
namespace Rasty\Geo\actions\provincias;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de una provincia.
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class BorrarProvincia extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "Provincias";
		
	}
	
	protected function getToPageName(){
		
		return "Provincias";
		
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