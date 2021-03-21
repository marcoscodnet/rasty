<?php
namespace Rasty\Geo\actions\paises;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Pais;
use Rasty\Crud\actions\AddEntity;

/**
 * se realiza el alta de un Pais.
 * @author bernardo
 * @since 20/08/2015
 */
class AgregarPais extends AddEntity {

	protected function getFromPageName(){
		return "PaisAdd";
	}
	
	protected function getEntityInstance(){

		return new Pais();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIPaisService();
	}
	
}
?>