<?php
namespace Rasty\Catalogo\actions\generos;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de un Genero.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class BorrarGenero extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "GeneroUpdate";
		
	}
	
	protected function getToPageName(){
		
		return "Generos";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIGeneroService();
			
	}
	
}
?>