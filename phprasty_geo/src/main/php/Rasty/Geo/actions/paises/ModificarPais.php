<?php
namespace Rasty\Geo\actions\paises;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de un Pais.
 * 
 * @author bernardo
 * @since 20/08/2015
 */
class ModificarPais extends UpdateEntity{

	protected function getFromPageName(){
		
		return "PaisUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIPaisService();
			
	}
	
}
?>