<?php
namespace Rasty\Geo\actions\provincias;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Provincia;
use Rasty\Crud\actions\AddEntity;

/**
 * se realiza el alta de una Provincia.
 * @author bernardo
 * @since 20/08/2015
 */
class AgregarProvincia extends AddEntity {

	protected function getFromPageName(){
		return "ProvinciaAdd";
	}
	
	protected function getEntityInstance(){

		return new Provincia();
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