<?php
namespace Rasty\Catalogo\components\grid\model;


/**
 * Model para la grilla de CondicionIva.
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class CondicionIvaGridModel extends CatalogoGridModel{

    public function getService(){
    	
    	return UIServiceFactory::getUICondicionIvaService();
    }
	
	protected function getViewPageName(){
		return "CondicionIvaView";
	}

	protected function getUpdatePageName(){
		return "CondicionIvaUpdate";
	}
	
	protected function getDeletePageName(){
		return "CondicionIvaDelete";
	}
    
}
?>