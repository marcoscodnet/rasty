<?php
namespace Rasty\Crud\pages\entities\delete;


use Rasty\components\RastyPage;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\utils\LinkBuilder;

abstract class EntityDelete extends RastyPage{


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
		
		$xtpl->assign("action", LinkBuilder::getActionUrl( $this->getDeleteAction() ) );
		
		$xtpl->assign("cancel", $this->getBackToLink() );
		
		$xtpl->assign("lbl_confirm", $this->getLabelConfirm() );
		$xtpl->assign("lbl_cancel", $this->getLabelCancel() );
	}

	protected abstract function getDeleteAction();
	
	protected function getLabelConfirm(){
		return $this->localize("form.confirm");
	}

	protected function getLabelCancel(){
		return $this->localize("form.cancel");
	}
	
	protected function getBackToLink(){
		
		return LinkBuilder::getPageUrl( $this->getBackTo(), $this->getBackToParams() ) ;
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

	public function getMenuGroups(){

		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName( $this->getBackTo() );
		$menuOption->setImageSource( $this->getWebPath() . "css/images/back_32.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	
	public function setEntity($entity)
	{
	    $this->entity = $entity;
	}
}
?>