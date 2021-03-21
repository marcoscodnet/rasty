<?php
namespace Rasty\Workflow\service\finder;

/**
 * 
 * Finder para CategoriaTarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 */

use Rasty\Workflow\components\filter\model\UICategoriaTareaCriteria;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Catalogo\service\finder\CatalogoFinder;


class CategoriaTareaFinder extends CatalogoFinder {
	
	
	protected function getUIService(){
		return UIServiceFactory::getUICategoriaTareaService();
	}
	
	protected function getUICriteria(){
		return new UICategoriaTareaCriteria();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributes()
	 */
	public function getAttributes(){
		return array("codigo", "descripcion", "padre");		
	}
	
		
}
?>