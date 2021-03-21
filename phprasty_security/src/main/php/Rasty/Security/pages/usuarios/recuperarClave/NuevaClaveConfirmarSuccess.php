<?php
namespace Rasty\Security\pages\usuarios\recuperarClave;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\utils\XTemplate;

use Cose\Security\model\NewPasswordRequest;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para el success de una confirmación de 
 * cambio de clave
 * 
 * @author bernardo
 * @since 20/01/2015
 *
 */
class NuevaClaveConfirmarSuccess extends RastySecurityPage{


	private $mensajeError;
	
	public function isSecure(){
		return false;
	}
	
	
	public function __construct(){
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("SolicitarPrestamo");//FIXME home public
//		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "nuevaClaveConfirmar.success.title" );
	}

	public function getType(){
		
		return "NuevaClaveConfirmarSuccess";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		//$xtpl->assign("nombre", $this->getN()->getNombre() );
		$xtpl->assign("login", $this->getLinkLogin() );
		$xtpl->parse("main.ok");
	}
					
	public function getMsgError(){
		return $this->getMensajeError();
	}

	
	public function getMensajeError()
	{
	    return $this->mensajeError;
	}

	public function setMensajeError($mensajeError)
	{
	    $this->mensajeError = $mensajeError;
	}
}
?>