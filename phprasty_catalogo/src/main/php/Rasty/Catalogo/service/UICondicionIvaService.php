<?php
namespace Rasty\Catalogo\service;

use Cose\Catalogo\service\ServiceFactory;

/**
 * 
 * UI service para CondicionIva.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class UICondicionIvaService extends UICatalogoService{
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UICondicionIvaService();
			
		}
		return self::$instance; 
	}
	
	protected function getService(){
		
		return ServiceFactory::getCondicionIvaService();
	}	
}
?>