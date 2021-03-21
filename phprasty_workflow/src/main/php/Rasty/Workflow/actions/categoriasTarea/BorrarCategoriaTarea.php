<?php
namespace Rasty\Workflow\actions\categoriasTarea;


use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Crud\actions\DeleteEntity;

/**
 * se realiza la eliminación de una CategoriaTarea
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class BorrarCategoriaTarea extends DeleteEntity{

	
	protected function getFromPageName(){
		
		return "CategoriaTareaUpdate";
		
	}
	
	protected function getToPageName(){
		
		return "CategoriasTarea";
		
	}
	
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUICategoriaTareaService();
			
	}
	
}
?>