<?php
namespace Rasty\Workflow\actions\tareas;


use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de una Tarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class ModificarTarea extends UpdateEntity{

	protected function getFromPageName(){
		
		return "TareaUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUITareaService();
			
	}
	
}
?>