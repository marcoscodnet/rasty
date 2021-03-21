<?php
namespace Rasty\Catalogo\actions\estadosCivil;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de un EstadoCivil.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class BorrarEstadoCivil extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "EstadoCivilUpdate";
		
	}
	
	protected function getToPageName(){
		
		return "EstadosCivil";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIEstadoCivilService();
			
	}
	
}
?>