<?php

namespace Rasty\Catalogo\components\filter\catalogo;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\Catalogo\components\grid\model\CatalogoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filter para Catalogo
 * 
 * @author Bernardo
 * @since 14/08/2015
 */
abstract class CatalogoFilter extends Filter{
		
	public function getType(){
		
		return "CatalogoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( $this->getCatalogoGridModelClazz() );
		
		$this->setUicriteriaClazz( get_class( new UICatalogoCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("codigo");
		
	}
	
	
	protected abstract function getCatalogoGridModelClazz();
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		//rellenamos el nombre con el texto inicial
		$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("catalogo.nombre") );
		$xtpl->assign("lbl_codigo",  $this->localize("catalogo.codigo") );
			
	}
}
?>