<?php

namespace Rasty\Catalogo\components\filter\catalogo;


/**
 * Filtro para buscar Genero
 * 
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\components\grid\model\GeneroGridModel;

class GeneroFilter extends CatalogoFilter{

	protected function getCatalogoGridModelClazz(){
		
		return get_class( new GeneroGridModel() );
	}

	public function getType(){
		
		return "GeneroFilter";
	}
	
}
?>