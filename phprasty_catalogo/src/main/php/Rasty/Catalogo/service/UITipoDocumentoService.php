<?php
namespace Rasty\Catalogo\service;

use Cose\Catalogo\service\ServiceFactory;

/**
 * 
 * UI service para TipoDocumento.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class UITipoDocumentoService extends UICatalogoService{
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UITipoDocumentoService();
			
		}
		return self::$instance; 
	}
	
	protected function getService(){
		
		return ServiceFactory::getTipoDocumentoService();
	}	
}
?>