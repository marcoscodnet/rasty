<?php
namespace Rasty\Geo\actions\localidades;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de una localidad.
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class BorrarLocalidad extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "Localidades";
		
	}
	
	protected function getToPageName(){
		
		return "Localidades";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUILocalidadService();
			
	}
	
	protected function addForwardParams($forward, $entity ){
		parent::addForwardParams($forward, $entity );
		$forward->addParam( "provinciaOid", $entity->getProvincia()->getOid() );
	}
}
?>