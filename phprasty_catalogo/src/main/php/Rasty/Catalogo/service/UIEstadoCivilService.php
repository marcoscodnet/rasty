<?php
namespace Rasty\Catalogo\service;

use Cose\Catalogo\service\ServiceFactory;

/**
 * 
 * UI service para EstadoCivil.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class UIEstadoCivilService extends UICatalogoService{
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIEstadoCivilService();
			
		}
		return self::$instance; 
	}
	
	protected function getService(){
		
		return ServiceFactory::getEstadoCivilService();
	}	
}
?>