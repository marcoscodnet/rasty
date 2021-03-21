<?php
namespace Rasty\Workflow\actions\tareas;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de una Tarea
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class BorrarTarea extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "TareaUpdate";
		
	}
	
	protected function getToPageName(){
		
		return "Tareas";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUITareaService();
			
	}
	
}
?>