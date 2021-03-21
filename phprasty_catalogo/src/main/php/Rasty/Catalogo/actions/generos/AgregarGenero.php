<?php
namespace Rasty\Catalogo\actions\generos;

use Rasty\Catalogo\service\UIServiceFactory;

use Rasty\Crud\actions\AddEntity;

use Cose\Catalogo\model\Genero;

/**
 * se realiza el alta de un Genero.
 * 
 * @author bernardo
 * @since 26/08/2015
 */
class AgregarGenero extends AddEntity {

	protected function getFromPageName(){
		return "GeneroAdd";
	}
	
	protected function getEntityInstance(){

		return new Genero();
	}
	
	protected function getEntityService(){
		
		return UIServiceFactory::getUIGeneroService();
	}
	
}
?>