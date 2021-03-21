<?php
namespace Rasty\Crud\pages\entities\view;


use Rasty\Crud\utils\RastyCrudUtils;

use Rasty\components\RastyPage;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\LinkBuilder;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;



abstract class EntityView extends RastyPage{


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
		
		return "EntityView";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "entityBox" );
		$componentConfig->setType( $this->getBoxType() );

		
	    $box = ComponentFactory::buildByType($componentConfig, $this);
	    $this->setEntityBox( $box, $this->getEntity() );
	    
	    $xtpl->assign("box", $box->render());
		$xtpl->assign("title", $this->getBoxTitle() );
		$xtpl->assign("legend", $this->getLegend() );
		
		$xtpl->assign("backToUrl", $this->getLinkBackTo() );
		$xtpl->assign("lbl_back", $this->localize("form.back") );
		
		
		
	}

	protected function getLinkBackTo(){
		
		return LinkBuilder::getPageUrl( $this->getBackTo(), $this->getBackToParams() );
		
	}
	public function getMenuGroups(){

		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setImageSource( $this->getWebPath() . "css/images/back_32.png" );
		$menuOption->setPageName( $this->getBackTo() );
		
		$params = $this->getBackToParams();
		foreach ($params as $key => $value) {
			$menuOption->addParam($key,$value);
		}
		
		$menuGroup->addMenuOption( $menuOption );

		
		if( $this->getUpdatePageName() ){

			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( $this->getUpdateLabel() ) );
			$menuOption->setPageName( $this->getUpdatePageName() );
			$menuOption->addParam("oid",$this->getEntity()->getOid());
			$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
			
			$options = RastyCrudUtils::addMenuOptionToGroup($menuOption, $menuGroup);
			
		}
		
		
		if( $this->getDeletePageName() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( $this->getDeleteLabel() ) );
			$menuOption->setPageName( $this->getDeletePageName() );
			$menuOption->addParam("oid",$this->getEntity()->getOid());
			$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
			$options = RastyCrudUtils::addMenuOptionToGroup($menuOption, $menuGroup);
		}
				
		
		return array($menuGroup);
	}
	
	
	protected function getBackToParams(){
		return array();
	}
	protected abstract function getBackTo();
	
	protected abstract function getLegend();
	
	protected abstract function getBoxType();
	
	protected abstract function getBoxTitle();
	
	protected abstract function setEntityBox( $form, $entity );

	public function getEntity()
	{
	    return $this->entity;
	}

	public function setEntity($entity)
	{
	    $this->entity = $entity;
	}
	

	protected function getUpdatePageName(){
		return "";
	}
	
	protected function getDeletePageName(){
		return "";
	}
    
	protected function getUpdateLabel(){
		return "menu.entity.modificar";
	}
	
	protected function getDeleteLabel(){
		return "menu.entity.eliminar";
	}
	
}
?>