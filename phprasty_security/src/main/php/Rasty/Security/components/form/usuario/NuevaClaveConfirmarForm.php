<?php

namespace Rasty\Security\components\form\usuario;



use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Cose\Security\model\NewPasswordRequest;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para confirmar el cambio de clave

 * @author Bernardo
 * @since 20/01/2015
 */
class NuevaClaveConfirmarForm extends Form{
		
	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;

	/**
	 * 
	 * @var NnewPasswordRequest
	 */
	private $newPasswordRequest;

	private $newPassword;
	
	private $repetirNewPassword;
	
	private $captcha;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("oid");
		$this->addProperty("validationCode");
		
		$this->setBackToOnSuccess("NuevaClaveConfirmarSuccess"); 
		$this->setBackToOnCancel("Login");
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//agregamos el captcha.
		$this->setCaptcha( RastyUtils::getParamPOST('captcha') );
		
		//agregamos las passwords.
		$this->setNewPassword( RastyUtils::getParamPOST('newPassword') );
		$this->setRepetirNewPassword( RastyUtils::getParamPOST('repetirNewPassword') );
		
	}
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "NuevaClaveConfirmarForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("nuevaClaveConfirmar_legend", $this->localize("nuevaClave.confirmar.legend") );
		
		$xtpl->assign("lbl_nombre", $this->localize("nuevaClave.username") );
		
		$xtpl->assign("lbl_password", $this->localize("nuevaClave.newPassword") );
		$xtpl->assign("lbl_passwordRepeat", $this->localize("nuevaClave.newPassword.repetir") );
		$xtpl->assign("claveFormato", $this->localize("usuario.clave.formato") );	
		$xtpl->assign("lbl_securitycode", $this->localize("nuevaClave.securitycode") );
		$xtpl->assign("lbl_captcha", $this->localize("nuevaClave.captcha") );
		$xtpl->assign ( 'sid_captcha', md5(time()) );
				
		
		if( $this->getNewPasswordRequest() ){
			
			$xtpl->assign("nombre", $this->getNewPasswordRequest()->getUser()->getName() );
			$xtpl->parse("main.ok");
			$xtpl->parse("main.submit");
		}else{
			$xtpl->parse("main.nook");
		}
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}


	public function getCaptcha()
	{
	    return $this->captcha;
	}

	public function setCaptcha($captcha)
	{
	    $this->captcha = $captcha;
	}

	public function getNewPasswordRequest()
	{
	    return $this->newPasswordRequest;
	}

	public function setNewPasswordRequest($newPasswordRequest)
	{
	    $this->newPasswordRequest = $newPasswordRequest;
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