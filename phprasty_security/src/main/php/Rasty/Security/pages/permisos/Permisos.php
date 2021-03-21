<?php
namespace Rasty\Security\pages\permisos;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\components\filter\model\UIPermisoCriteria;

use Rasty\Security\components\grid\model\PermisoGridModel;

use Rasty\Security\service\UIPermisoService;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los permisos
 * 
 * @author Bernardo
 * @since 27/12/2014
 *
 * @Rasty\security\annotations\Secured( permission='CONSULTAR PERMISOS' )
 */
class Permisos extends RastySecurityPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "permisos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del permiso 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "permiso.agregar") );
		$menuOption->setPageName("PermisoAgregar");
		$menuOption->setIconClass( "icon-agregar" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Permisos";
		
	}	

	public function getModelClazz(){
		return get_class( new PermisoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIPermisoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("lbl_add", $this->localize("menu.permisos.agregar") );
		$xtpl->assign("linkAdd", $this->getLinkPermisoAgregar() );
		
		$xtpl->parse("main.opciones.add");
		$xtpl->parse("main.opciones");
	}

}
?>