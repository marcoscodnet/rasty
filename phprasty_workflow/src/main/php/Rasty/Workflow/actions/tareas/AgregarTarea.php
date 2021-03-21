<?php
namespace Rasty\Workflow\actions\tareas;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\actions\AddEntity;

use Cose\Workflow\model\Tarea;

/**
 * se realiza el alta de una Tarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class AgregarTarea extends AddEntity {

	protected function getFromPageName(){
		return "TareaAdd";
	}
	
	protected function getEntityInstance(){

		return new Tarea();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUITareaService();
		
	}
	
}
?>