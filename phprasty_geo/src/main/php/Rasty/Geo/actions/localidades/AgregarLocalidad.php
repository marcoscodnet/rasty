<?php
namespace Rasty\Geo\actions\localidades;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Localidad;
use Rasty\Crud\actions\AddEntity;

/**
 * se realiza el alta de una Localidad.
 * @author bernardo
 * @since 20/08/2015
 */
class AgregarLocalidad extends AddEntity {

	protected function getFromPageName(){
		return "LocalidadAdd";
	}
	
	protected function getEntityInstance(){

		return new Localidad();
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