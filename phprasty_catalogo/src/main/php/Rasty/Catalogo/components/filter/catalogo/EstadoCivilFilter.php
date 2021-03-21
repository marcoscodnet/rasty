<?php

namespace Rasty\Catalogo\components\filter\catalogo;


/**
 * Filtro para buscar EstadoCivil
 * 
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\components\grid\model\EstadoCivilGridModel;

class EstadoCivilFilter extends CatalogoFilter{

	protected function getCatalogoGridModelClazz(){
		
		return get_class( new EstadoCivilGridModel() );
	}

	public function getType(){
		
		return "EstadoCivilFilter";
	}
	
}
?>