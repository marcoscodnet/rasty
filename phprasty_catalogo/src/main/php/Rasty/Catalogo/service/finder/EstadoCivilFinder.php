<?php
namespace Rasty\Catalogo\service\finder;


/**
 * 
 * Finder para EstadoCivil.
 * 
 * @author bernardo
 * @since 28/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class EstadoCivilFinder extends CatalogoFinder {
	
	
	protected function getUIService(){
		UIServiceFactory::getUIEstadoCivilService();
	}
		
}
?>