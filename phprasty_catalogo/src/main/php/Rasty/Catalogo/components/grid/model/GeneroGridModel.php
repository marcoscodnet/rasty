<?php
namespace Rasty\Catalogo\components\grid\model;


/**
 * Model para la grilla de Genero.
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class GeneroGridModel extends CatalogoGridModel{

    public function getService(){
    	
    	return UIServiceFactory::getUIGeneroService();
    }
	
	protected function getViewPageName(){
		return "GeneroView";
	}

	protected function getUpdatePageName(){
		return "GeneroUpdate";
	}
	
	protected function getDeletePageName(){
		return "GeneroDelete";
	}
    
}
?>