<?php
namespace Rasty\Security\pages\roles\agregar;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\utils\XTemplate;
use Cose\Security\model\UserGroup;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar roles
 * 
 * @author Bernardo
 * @since 27/12/2014
 * 
 * @Rasty\security\annotations\Secured( permission='AGREGAR ROL' )
 */
class RolAgregar extends RastySecurityPage{

	/**
	 * Roles a agregar.
	 * @var Rol
	 */
	private $rol;

	
	public function __construct(){
		
		//inicializamos el rol.
		$rol = new UserGroup();
		
		$this->setRol($rol);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del rol 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Roles");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "rol.agregar.title" );
	}

	public function getType(){
		
		return "RolAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$rolForm = $this->getComponentById("rolForm");
		$rolForm->fillFromSaved( $this->getRol() );
		
	}


	public function getRol()
	{
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>