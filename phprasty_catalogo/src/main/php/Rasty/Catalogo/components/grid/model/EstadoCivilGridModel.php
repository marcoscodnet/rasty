<?php
namespace Rasty\Catalogo\components\grid\model;


/**
 * Model para la grilla de EstadoCivil.
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class EstadoCivilGridModel extends CatalogoGridModel{

    public function getService(){
    	
    	return UIServiceFactory::getUIEstadoCivilService();
    }
	
	protected function getViewPageName(){
		return "EstadoCivilView";
	}

	protected function getUpdatePageName(){
		return "EstadoCivilUpdate";
	}
	
	protected function getDeletePageName(){
		return "EstadoCivilDelete";
	}
    
}
?>