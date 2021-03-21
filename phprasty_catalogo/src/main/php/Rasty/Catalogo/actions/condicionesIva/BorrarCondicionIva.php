<?php
namespace Rasty\Catalogo\actions\condicionesIva;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de un CondicionIva.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class BorrarCondicionIva extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "CondicionIvaUpdate";
		
	}
	
	protected function getToPageName(){
		
		return "CondicionesIva";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUICondicionIvaService();
			
	}
	
}
?>