<?php
namespace Rasty\Crud\pages\entities\update;


use Rasty\Crud\utils\RastyCrudUtils;

use Rasty\components\RastyPage;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

abstract class EntityUpdate extends RastyPage{


	/**
	 * entity a modificar.
	 */
	private $entity;

	
	public function __construct(){
		
				
	}
	
	protected abstract function getEntityService();
	
	public function setEntityOid($oid){
		
		if(!empty($oid)){
			
			//a partir del id buscamos la entity a modificar.
			$entity = $this->getEntityService()->get($oid);
			
			$this->setEntity( $entity );
				
		}
		
		
	}
	
	public function getType(){
		
		return "EntityUpdate";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$form = $this->getForm();
	    
	    $form->fillInput("oid", $this->getEntity()->getOid());

	    $this->setEntityForm( $form, $this->getEntity() );
	     
	    $form->fillForm($this->getEntity());
	   
	    
	    $xtpl->assign("form", $form->render());
	    
		
	}
	
	public function getForm(){
		
		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "entityForm" );
		$componentConfig->setType( $this->getFormType() );
		
		
	    $form = ComponentFactory::buildByType($componentConfig, $this);
		$form->setLegend( $this->getLegend() );
	    $form->setBackToOnSuccess( RastyUtils::getParamGET("backTo", $this->getBackTo()) );
	    $form->setBackToOnCancel(  RastyUtils::getParamGET("backTo", $this->getBackTo()) );
	    $form->setAction( $this->getFormAction() );
	    $form->setMethod( $this->getFormMethod() );
	    
	    return $form;
		
	}

	protected abstract function getBackTo();
	
	protected abstract function getLegend();
	
	protected abstract function getFormType();
	
	protected abstract function getFormAction();
	
	protected function getFormMethod(){
		return "POST";
	}
	
	protected abstract function setEntityForm( $form, $entity );
	
	public function getMenuGroups(){

		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName( $this->getBackTo() );
		$menuOption->setImageSource( $this->getWebPath() . "css/images/back_32.png" );
		$menuGroup->addMenuOption( $menuOption );

		return array($menuGroup);
	}
	

	public function getEntity()
	{
	    return $this->entity;
	}

	public function setEntity($entity)
	{
	    $this->entity = $entity;
	}
}
?>