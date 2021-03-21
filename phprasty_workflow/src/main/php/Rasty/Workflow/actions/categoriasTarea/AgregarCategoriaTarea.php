<?php
namespace Rasty\Workflow\actions\categoriasTarea;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\actions\AddEntity;

use Cose\Workflow\model\CategoriaTarea;

/**
 * se realiza el alta de una CategoriaTarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class AgregarCategoriaTarea extends AddEntity {

	protected function getFromPageName(){
		return "CategoriaTareaAdd";
	}
	
	protected function getEntityInstance(){

		return new CategoriaTarea();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUICategoriaTareaService();
	}
	
}
?>