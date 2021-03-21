<?php

namespace Rasty\Security\components\filter\rol;

use Rasty\Security\components\filter\model\UIRolCriteria;

use Rasty\Security\components\grid\model\RolGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar Roles
 * 
 * @author Bernardo
 * @since 06/11/2014
 */
class RolFilter extends Filter{
		
	public function getType(){
		
		return "RolFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new RolGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIRolCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("name");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("name", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_name",  $this->localize("rol.name") );
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "RolModificar") );
		
		
	}
}
?>