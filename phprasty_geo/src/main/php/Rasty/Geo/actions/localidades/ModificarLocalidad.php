<?php
namespace Rasty\Geo\actions\localidades;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de una Localidad.
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class ModificarLocalidad extends UpdateEntity{

	protected function getFromPageName(){
		
		return "LocalidadUpdate";
		
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