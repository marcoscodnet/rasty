<?php
namespace Rasty\Catalogo\service\finder;


/**
 * 
 * Finder para CondicionIva.
 * 
 * @author bernardo
 * @since 28/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class CondicionIvaFinder extends CatalogoFinder {
	
	
	protected function getUIService(){
		UIServiceFactory::getUICondicionIvaService();
	}
		
}
?>