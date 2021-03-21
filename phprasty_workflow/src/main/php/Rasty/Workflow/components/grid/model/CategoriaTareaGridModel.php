<?php
namespace Rasty\Workflow\components\grid\model;

use Rasty\Workflow\components\filter\model\UICategoriaTareaCriteria;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Catalogo\components\grid\model\CatalogoGridModel;

/**
 * Model para la grilla de CategoriaTarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 * 
 */


class CategoriaTareaGridModel extends CatalogoGridModel{


	public function getFilter(){
    	
    	$filter = new UICategoriaTareaCriteria();
		return $filter;    	
    }
	
    public function getService(){
    	
    	return UIServiceFactory::getUICategoriaTareaService();
    }
	
	protected function getViewPageName(){
		return "CategoriaTareaView";
	}

	protected function getUpdatePageName(){
		return "CategoriaTareaUpdate";
	}
	
	protected function getDeletePageName(){
		return "CategoriaTareaDelete";
	}
    
}
?>