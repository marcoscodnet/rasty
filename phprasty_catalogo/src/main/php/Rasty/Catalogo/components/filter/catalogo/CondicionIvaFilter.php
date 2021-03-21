<?php

namespace Rasty\Catalogo\components\filter\catalogo;


/**
 * Filtro para buscar CondicionIva
 * 
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\components\grid\model\CondicionIvaGridModel;

class CondicionIvaFilter extends CatalogoFilter{

	protected function getCatalogoGridModelClazz(){
		
		return get_class( new CondicionIvaGridModel() );
	}

	public function getType(){
		
		return "CondicionIvaFilter";
	}
	
}
?>