<?php
namespace Rasty\Geo\actions\paises;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de un pais.
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class BorrarPais extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "Paises";
		
	}
	
	protected function getToPageName(){
		
		return "Paises";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIPaisService();
			
	}
	
}
?>