<?php
namespace Rasty\Security\pages\usuarios\agregar;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar usuarios
 * 
 * @author Bernardo
 * @since 06/11/2014
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR USUARIO' )
 */
class UsuarioAgregar extends RastySecurityPage{

	/**
	 * Usuario a agregar.
	 * @var User
	 */
	private $usuario;

	
	public function __construct(){
		
		//inicializamos el usuario.
		$usuario = new User();
		
		$this->setUsuario($usuario);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Usuarios");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "usuario.agregar.title" );
	}

	public function getType(){
		
		return "UsuarioAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		
	}


	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>