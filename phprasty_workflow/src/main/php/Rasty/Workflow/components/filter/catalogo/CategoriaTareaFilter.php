<?php
namespace Rasty\Workflow\components\filter\catalogo;

use Rasty\Workflow\components\filter\model\UICategoriaTareaCriteria;

use Rasty\Workflow\components\grid\model\CategoriaTareaGridModel;

use Rasty\Catalogo\components\filter\catalogo\CatalogoFilter;


/**
 * Filtro para buscar CategoriaTarea
 * 
 * @author bernardo
 * @since 02/09/2015
 */

class CategoriaTareaFilter extends CatalogoFilter{


	public function __construct(){
		
		parent::__construct();
		
		
		$this->setUicriteriaClazz( get_class( new UICategoriaTareaCriteria()) );
		
	}
	
	
	protected function getCatalogoGridModelClazz(){
		
		return get_class( new CategoriaTareaGridModel() );
	}

	public function getType(){
		
		return "CategoriaTareaFilter";
	}
	
}
?>