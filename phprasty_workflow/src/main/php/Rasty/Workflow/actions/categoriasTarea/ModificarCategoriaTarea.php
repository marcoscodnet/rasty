<?php
namespace Rasty\Workflow\actions\categoriasTarea;


use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\actions\UpdateEntity;

/**
 * se realiza la actualización de una CategoriaTarea.
 * 
 * @author bernardo
 * @since 27/08/2015
 */
class ModificarCategoriaTarea extends UpdateEntity{

	protected function getFromPageName(){
		
		return "CategoriaTareaUpdate";
		
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUICategoriaTareaService();
			
	}
	
}
?>