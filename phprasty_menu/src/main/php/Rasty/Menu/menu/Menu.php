<?php

namespace Rasty\Menu\menu;

use Rasty\Menu\menu\model\MenuGroup;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;
use Rasty\utils\ReflectionUtils;
use Rasty\utils\LinkBuilder;
/**
 * componente menu.
 * 
 * @author bernardo
 * @since 15-08-2013
 *
 */
class Menu extends RastyComponent{

	/**
	 * label del menú.
	 * @var string
	 */
	private $label;
	
	/**
	 * onclick del menu
	 * @var string (js)
	 */
	private $onclick;
	
	/**
	 * menu groups
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $menuGroups;
	
	
	public function __construct(){
	
		$this->menuGroups = array();
		
	}

	public function getType(){
	
		return "Menu";
		
	}
	protected function initDefaults(){
	
		if( empty( $this->label ) ){
			//$this->setLabel( $this->localize("menu.label"));
		}
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$this->initDefaults();
		
		foreach ($this->menuGroups as $menuGroup) {
			
			foreach ($menuGroup->getMenuOptions() as $menuOption) {
				$xtpl->assign("label", $menuOption->getLabel() );
				
				
				$xtpl->assign("onclick", $menuOption->getOnclick());
				
				$img = $menuOption->getImageSource();
				if(!empty($img)){
					$xtpl->assign("src", $img );
					$xtpl->parse("main.menuGroup.menuOption.image");
				}else{
					$icon =  $menuOption->getIconClass();
					if(!empty($icon)){
						$xtpl->assign("iconClass", $icon);
						$xtpl->parse("main.menuGroup.menuOption.icon");
					}
				}
				
				
				$xtpl->parse("main.menuGroup.menuOption");
			}
			$xtpl->parse("main.menuGroup");
		}
		
		$xtpl->assign("menuLabel", $this->getLabel() );
		$xtpl->assign("onclick", $this->getOnclick() );
		$xtpl->assign("id", $this->getId() );
		
		if( !empty($this->label) )
			$xtpl->parse("main.menuTitle" );
		
	}



	public function getLabel()
	{
	    return $this->label;
	}

	public function setLabel($label)
	{
	    $this->label = $label;
	}

	public function getMenuGroups()
	{
	    return $this->menuGroups;
	}

	public function setMenuGroups($menuGroups)
	{
	    $this->menuGroups = $menuGroups;
	}
	
	public function addMenuGroup(MenuGroup $menuGroup){
	
		$this->menuGroups[] = $menuGroup;
	}
	

	public function getOnclick()
	{
	    return $this->onclick;
	}

	public function setOnclick($onclick)
	{
	    $this->onclick = $onclick;
	}
}