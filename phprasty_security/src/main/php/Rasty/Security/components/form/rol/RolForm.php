<?php

namespace Rasty\Security\components\form\rol;

use Rasty\Security\components\filter\model\UIRolCriteria;

use Rasty\Security\service\finder\RolFinder;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Security\Core\model\Rol;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para rol

 * @author Bernardo
 * @since 27/13/2014
 */
class RolForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Rol
	 */
	private $rol;

	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("name");
		$this->addProperty("description");

		$this->setBackToOnSuccess("Roles");
		$this->setBackToOnCancel("Roles");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "RolForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_name", $this->localize("rol.name") );
		$xtpl->assign("lbl_description", $this->localize("rol.description") );
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//uppercase 
		$entity->setName( strtoupper( $entity->getName() ) );
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getRol()
	{
	    return $this->rol;
	}

	public function setRol($rol)
	{
	    $this->rol = $rol;
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
}
?>