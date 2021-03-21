<?php
namespace Rasty\Catalogo\actions\condicionesIva;


use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de un Genero.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class ModificarGenero extends UpdateEntity{

	protected function getFromPageName(){
		
		return "GeneroUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIGeneroService();
			
	}
	
}
?>