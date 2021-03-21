<?php

namespace Rasty\Menu\menu\model;

use Rasty\utils\LinkBuilder;

/**
 * menu option tipo submenu.
 * 
 * @author bernardo
 * @since 02-06-2014
 *
 */
class SubmenuOption extends MenuOption{

	private $menuGroup;

	
	public function __construct(MenuGroup $menuGroup ){
	
		$this->setMenuGroup($menuGroup);
	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see menu/model/Rasty\Menu\menu\model.MenuOption::getLink()
	 */
	public function getLink(){
		return "";
	}
	
	
	public function getMenuGroup()
	{
	    return $this->menuGroup;
	}

	public function setMenuGroup($menuGroup)
	{
	    $this->menuGroup = $menuGroup;
	}
	
	public function hasSubmenu(){
		return true;
	}
	
	public function getLabel(){
	
		return $this->getMenuGroup()->getLabel();
	}
	
	public function getMenuOptions(){
		return $this->getMenuGroup()->getMenuOptions();
	}
	
	
}