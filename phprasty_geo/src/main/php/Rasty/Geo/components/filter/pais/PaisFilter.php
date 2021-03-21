<?php

namespace Rasty\Geo\components\filter\pais;

use Rasty\Geo\components\filter\model\UIPaisCriteria;

use Rasty\Geo\components\grid\model\PaisGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filter para Catalogo
 * 
 * @author Bernardo
 * @since 14/08/2015
 */
class PaisFilter extends Filter{
		
	public function getType(){
		
		return "PaisFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new PaisGridModel() ) );
		
		$this->setUicriteriaClazz( get_class( new UIPaisCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("codigo");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("pais.nombre") );
		$xtpl->assign("lbl_codigo",  $this->localize("pais.codigo") );
			
	}
}
?>