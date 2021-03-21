<?php
namespace Rasty\Security\pages\usuarios\eliminar;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\Security\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Cose\Security\model\User;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para eliminar un usuario
 * 
 * @author bernardo
 * @since 22-01-2015
 *
 * @Rasty\security\annotations\Secured( permission='ELIMINAR USUARIO' )
 */
class UsuarioEliminar extends RastySecurityPage{

	/**
	 * usuario a eliminar.
	 * @var Usuario
	 */
	private $usuario;

	private $error;
	
	public function __construct(){
		
		//inicializamos el usuario.
		$usuario = new User();
		$this->setUsuario($usuario);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setUsuarioOid($oid){
		
		//a partir del id buscamos el usuario a modificar.
		$usuario = UIServiceFactory::getUIUsuarioService()->get($oid);
		
		$this->setUsuario($usuario);
		
	}
	
	public function getTitle(){
		return $this->localize( "usuario.eliminar.title" );
	}

	public function getType(){
		
		return "UsuarioEliminar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$xtpl->assign("legend", $this->localize( "usuario.eliminar.legend" ) );
		
		$xtpl->assign("cancel", $this->getLinkUsuarios() );
		$xtpl->assign("lbl_cancel", $this->localize( "form.cancelar" ) );
		
		$xtpl->assign("action", $this->getLinkActionEliminarUsuario() );
		$xtpl->assign("lbl_submit", $this->localize( "form.aceptar" ) );
		
		
		$xtpl->assign("lbl_username", $this->localize("usuario.username") );
		$xtpl->assign("lbl_name", $this->localize("usuario.name") );
		$xtpl->assign("lbl_email", $this->localize("usuario.email") );

		$xtpl->assign("username", $this->getUsuario()->getUsername() );
		$xtpl->assign("name", $this->getUsuario()->getName() );
		$xtpl->assign("email", $this->getUsuario()->getEmail() );
		
		$error = $this->getError();
		if(!empty($error)){
			$xtpl->assign("msg", $error );	
			$xtpl->parse("main.msg_error" );
		}
		
	}

	public function getUsuario(){
		
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
	

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>