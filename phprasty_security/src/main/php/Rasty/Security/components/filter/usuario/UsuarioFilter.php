<?php

namespace Rasty\Security\components\filter\usuario;

use Rasty\Security\components\filter\model\UIUsuarioCriteria;

use Rasty\Security\components\grid\model\UsuarioGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar Usuarios
 * 
 * @author Bernardo
 * @since 06/11/2014
 */
class UsuarioFilter extends Filter{
		
	public function getType(){
		
		return "UsuarioFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new UsuarioGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIUsuarioCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("username");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("username", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_username",  $this->localize("usuario.username") );
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "UsuarioModificar") );
		
		
	}
}
?>