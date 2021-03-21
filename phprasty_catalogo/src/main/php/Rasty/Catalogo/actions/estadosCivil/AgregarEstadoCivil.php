<?php
namespace Rasty\Catalogo\actions\estadosCivil;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\AddEntity;

use Cose\Catalogo\model\EstadoCivil;

/**
 * se realiza el alta de un EstadoCivil.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class AgregarEstadoCivil extends AddEntity {

	protected function getFromPageName(){
		return "EstadoCivilAdd";
	}
	
	protected function getEntityInstance(){

		return new EstadoCivil();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIEstadoCivilService();
	}
	
}
?>