<?php
namespace Rasty\Catalogo\service\finder;


/**
 * 
 * Finder para Genero.
 * 
 * @author bernardo
 * @since 28/08/2015
 */
use Rasty\Catalogo\service\UIServiceFactory;

class GeneroFinder extends CatalogoFinder {
	
	
	protected function getUIService(){
		UIServiceFactory::getUIGeneroService();
	}
		
}
?>