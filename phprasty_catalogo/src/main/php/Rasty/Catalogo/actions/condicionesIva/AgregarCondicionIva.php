<?php
namespace Rasty\Catalogo\actions\condicionesIva;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\AddEntity;

use Cose\Catalogo\model\CondicionIva;

/**
 * se realiza el alta de un CondicionIva.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class AgregarCondicionIva extends AddEntity {

	protected function getFromPageName(){
		return "CondicionIvaAdd";
	}
	
	protected function getEntityInstance(){

		return new CondicionIva();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUICondicionIvaService();
	}
	
}
?>