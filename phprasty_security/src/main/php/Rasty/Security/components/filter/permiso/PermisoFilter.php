<?php

namespace Rasty\Security\components\filter\permiso;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Security\components\filter\model\UIPermisoCriteria;

use Rasty\Security\components\grid\model\PermisoGridModel;
use Rasty\Security\service\finder\PermisoFinder;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar Permisos
 * 
 * @author Bernardo
 * @since 06/11/2014
 */
class PermisoFilter extends Filter{
		
	public function getType(){
		
		return "PermisoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new PermisoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIPermisoCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("name");
		$this->addProperty("parent");
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("name", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_name",  $this->localize("permiso.name") );
		$xtpl->assign("lbl_parent",  $this->localize("permiso.padre") );
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "PermisoModificar") );
		
		
	}
	
	public function getPermisoFinderClazz(){
		
		return get_class( new PermisoFinder() );
		
	}	

	public function getPermisos(){
		
		
		$categorias = UIServiceFactory::getUIPermisoService()->getList( new UIPermisoCriteria() );
		
		return $categorias;
		
	}
}
?>