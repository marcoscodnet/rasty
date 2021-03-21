<?php
namespace Rasty\Crud\pages\entities\add;


use Rasty\components\RastyPage;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

abstract class EntityAdd extends RastyPage{

	/**
	 * entity a agregar.
	 */
	private $entity;

	
	public function __construct(){
		
		
	}
	
	public function getType(){
		
		return "EntityAdd";
		
	}	

	public function getForm(){
		
		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "entityForm" );
		$componentConfig->setType( $this->getFormType() );
		
		
	    $form = ComponentFactory::buildByType($componentConfig, $this);
		$form->setLegend( $this->getLegend() );
	    $form->setBackToOnSuccess( RastyUtils::getParamGET("backTo", $this->getBackTo()) );
	    $form->setBackToOnCancel( RastyUtils::getParamGET("backTo", $this->getBackTo()) );
	    $form->setAction( $this->getFormAction() );
	    $form->setMethod( $this->getFormMethod() );
	    
	    return $form;
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		$form = $this->getForm();

		$this->setEntityForm( $form, $this->getEntity() );
	    $xtpl->assign("form", $form->render());
		
	}

	protected abstract function getBackTo();
	
	protected abstract function getLegend();
	
	protected abstract function getFormType();
	
	protected abstract function getFormAction();
	
	protected function getFormMethod(){
		return "POST";
	}
	
	protected abstract function setEntityForm( $form, $entity );
	
	
	public function getMsgError(){
		return "";
	}

	public function getEntity()
	{
	    return $this->entity;
	}

	public function setEntity($entity)
	{
	    $this->entity = $entity;
	}
	
		
	public function getMenuGroups(){

		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName( $this->getBackTo() );
		$menuOption->setImageSource( $this->getWebPath() . "css/images/back_32.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
}
?>