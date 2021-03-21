<?php
namespace Rasty\Catalogo\service\finder;


/**
 * 
 * Finder para TipoDocumento.
 * 
 * @author bernardo
 * @since 28/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class TipoDocumentoFinder extends CatalogoFinder {
	
	
	protected function getUIService(){
		return UIServiceFactory::getUITipoDocumentoService();
	}
		
}
?>