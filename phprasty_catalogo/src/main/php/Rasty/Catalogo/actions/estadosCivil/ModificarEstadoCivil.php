<?php
namespace Rasty\Catalogo\actions\estadosCivil;


use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de un EstadoCivil.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class ModificarEstadoCivil extends UpdateEntity{

	protected function getFromPageName(){
		
		return "EstadoCivilUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIEstadoCivilService();
			
	}
	
}
?>