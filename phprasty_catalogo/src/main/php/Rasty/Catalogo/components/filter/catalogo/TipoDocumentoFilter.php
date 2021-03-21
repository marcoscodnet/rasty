<?php

namespace Rasty\Catalogo\components\filter\catalogo;


/**
 * Filtro para buscar TipoDocumento
 * 
 * @author bernardo
 * @since 26/08/2015
 */
use Rasty\Catalogo\components\grid\model\TipoDocumentoGridModel;

class TipoDocumentoFilter extends CatalogoFilter{

	protected function getCatalogoGridModelClazz(){
		
		return get_class( new TipoDocumentoGridModel() );
	}

	public function getType(){
		
		return "TipoDocumentoFilter";
	}
	
}
?>