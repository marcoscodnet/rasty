<?php
namespace Rasty\Catalogo\components\grid\model;


/**
 * Model para la grilla de TipoDocumento.
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class TipoDocumentoGridModel extends CatalogoGridModel{

    public function getService(){
    	
    	return UIServiceFactory::getUITipoDocumentoService();
    }
	
	protected function getViewPageName(){
		return "TipoDocumentoView";
	}

	protected function getUpdatePageName(){
		return "TipoDocumentoUpdate";
	}
	
	protected function getDeletePageName(){
		return "TipoDocumentoDelete";
	}
    
}
?>