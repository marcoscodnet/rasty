<?php
namespace Rasty\Workflow\service;

use Cose\Workflow\service\ServiceFactory;
use Rasty\Catalogo\service\UICatalogoService;

/**
 * 
 * UI service para CategoriaTarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 */
class UICategoriaTareaService extends UICatalogoService{
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UICategoriaTareaService();
			
		}
		return self::$instance; 
	}
	
	protected function getService(){
		
		return ServiceFactory::getCategoriaTareaService();
	}	
}
?>