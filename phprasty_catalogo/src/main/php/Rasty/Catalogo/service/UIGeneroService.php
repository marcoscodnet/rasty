<?php
namespace Rasty\Catalogo\service;

use Cose\Catalogo\service\ServiceFactory;

/**
 * 
 * UI service para Genero.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class UIGeneroService extends UICatalogoService{
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIGeneroService();
			
		}
		return self::$instance; 
	}
	
	protected function getService(){
		
		return ServiceFactory::getGeneroService();
	}	
}
?>