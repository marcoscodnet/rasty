<?php
namespace Rasty\Security\pages\usuarios;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\components\filter\model\UIUsuarioCriteria;

use Rasty\Security\components\grid\model\UsuarioGridModel;

use Rasty\Security\service\UIUsuarioService;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los usuarios
 * 
 * @author Bernardo
 * @since 06/11/2014
 *
 * @Rasty\security\annotations\Secured( permission='CONSULTAR USUARIOS' )
 */

class Usuarios extends RastySecurityPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "usuarios.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "usuario.agregar") );
		$menuOption->setPageName("UsuarioAgregar");
		$menuOption->setIconClass( "icon-agregar" );
		$menuGroup->addMenuOption( $menuOption );
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Usuarios";
		
	}	

	public function getModelClazz(){
		return get_class( new UsuarioGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIUsuarioCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("lbl_add", $this->localize("menu.usuarios.agregar") );
		$xtpl->assign("linkAdd", $this->getLinkUsuarioAgregar() );
		
		$xtpl->parse("main.opciones.add");
		$xtpl->parse("main.opciones");
	}

}
?>