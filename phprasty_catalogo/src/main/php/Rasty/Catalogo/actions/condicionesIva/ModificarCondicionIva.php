<?php
namespace Rasty\Catalogo\actions\condicionesIva;


use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de un CondicionIva.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class ModificarCondicionIva extends UpdateEntity{

	protected function getFromPageName(){
		
		return "CondicionIvaUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUICondicionIvaService();
			
	}
	
}
?>