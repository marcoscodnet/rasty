<?php
namespace Rasty\Security\pages\usuarios\recuperarClave;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Security\service\UIRegistracionService;

use Rasty\Security\pages\RastySecurityPage;

use Rasty\utils\XTemplate;

use Cose\Security\model\NewPasswordRequest;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\exception\RastyException;

/**
 * Page para confirmar una nueva clave
 * 
 * @author bernardo
 * @since 20/01/2015
 *
 */
class NuevaClaveConfirmar extends RastySecurityPage{

	/**
	 * newPasswordRequest a confirmar.
	 * @var NewPasswordRequest
	 */
	private $newPasswordRequest;

	private $mensajeError;
	
	public function isSecure(){
		return false;
	}
	
	
	public function __construct(){
		
		//inicializamos la Registracion.
		$newPasswordRequest = new NewPasswordRequest();
		
		$this->setNewPasswordRequest($newPasswordRequest);
		
		
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
		return $this->localize( "nuevaClave.confirmar.title" );
	}

	public function getType(){
		
		return "NuevaClaveConfirmar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		if($this->mensajeError){
			
			$xtpl->assign("error", $this->mensajeError);
			$xtpl->parse("main.error");
		}
		
	}

	public function getMsgError(){
		return $this->mensajeError;
	}

	
	public function setCodigoValidacion($codigoValidacion)
	{
		
	    $solicitud = UIServiceFactory::getUIUsuarioService()->getSolicitudNuevaClaveByCodigoValidacion($codigoValidacion);
	    
	    if( !$solicitud )
	    	$this->setMensajeError("nuevaClave.confirmar.codigoInvalido");
	    else{
			//chequeamos que no esté expirada.
			$hoy = new \DateTime();
			
			if( $solicitud->getExpirationDate() < $hoy ){
				$this->setMensajeError("nuevaClave.confirmar.codigoExpirado");
			}
		    	
	    }
	    	
	    $this->setNewPasswordRequest($solicitud);
	    
	}

	public function getMensajeError()
	{
	    return $this->mensajeError;
	}

	public function setMensajeError($mensajeError)
	{
	    $this->mensajeError = $mensajeError;
	}

	public function getNewPasswordRequest()
	{
	    return $this->newPasswordRequest;
	}

	public function setNewPasswordRequest($newPasswordRequest)
	{
	    $this->newPasswordRequest = $newPasswordRequest;
	}
}
?>