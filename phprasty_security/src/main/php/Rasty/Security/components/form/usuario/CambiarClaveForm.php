<?php

namespace Rasty\Security\components\form\usuario;

use Rasty\Security\components\filter\model\UIUsuarioCriteria;

use Rasty\Security\service\finder\UsuarioFinder;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Security\Core\model\Usuario;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para cambio de clave de usuario

 * @author Bernardo
 * @since 17/01/2015
 */
class CambiarClaveForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Usuario
	 */
	private $usuario;

	private $repetirNewPassword;
	private $oldPassword;
	private $newPassword;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("password");

		$this->setBackToOnSuccess("Usuarios");
		$this->setBackToOnCancel("Usuarios");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	

	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//agregamos las passwords.
		$this->setNewPassword( RastyUtils::getParamPOST('newPassword') );
		$this->setRepetirNewPassword( RastyUtils::getParamPOST('repetirNewPassword') );
		$this->setOldPassword( RastyUtils::getParamPOST('oldPassword') );
	
	}
	
	public function getType(){
		
		return "CambiarClaveForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_password", $this->localize("usuario.newPassword") );
		$xtpl->assign("lbl_passwordRepeat", $this->localize("usuario.password.repeat") );
		$xtpl->assign("lbl_oldPassword", $this->localize("usuario.password.old") );
		
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	public function getOldPassword()
	{
	    return $this->oldPassword;
	}

	public function setOldPassword($oldPassword)
	{
	    $this->oldPassword = $oldPassword;
	}

	public function getNewPassword()
	{
	    return $this->newPassword;
	}

	public function setNewPassword($newPassword)
	{
	    $this->newPassword = $newPassword;
	}

	public function getRepetirNewPassword()
	{
	    return $this->repetirNewPassword;
	}

	public function setRepetirNewPassword($repetirNewPassword)
	{
	    $this->repetirNewPassword = $repetirNewPassword;
	}
	
	public function getClaveProperties(){
		
		return array("data-custom" => "checkFormatoClave", 
						"data-custom-msg" => "formato incorrecto");
	}
	
}
?>