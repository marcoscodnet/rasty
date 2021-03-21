<?php

namespace Rasty\Menu\menu\model;

use Rasty\utils\LinkBuilder;

/**
 * menu option a un action.
 * 
 * @author bernardo
 * @since 15-08-2013
 *
 */
class MenuActionOption extends MenuOption{

	
	/**
	 * nombre del action a consultar
	 * @var string
	 */	
	private $actionName;
	
	/**
	 * (non-PHPdoc)
	 * @see menu/model/Rasty\Menu\menu\model.MenuOption::getLink()
	 */
	public function getLink(){
		return LinkBuilder::getActionUrl($this->getActionName(), $this->getParams() );
	}

	public function getActionName()
	{
	    return $this->actionName;
	}

	public function setActionName($actionName)
	{
	    $this->actionName = $actionName;
	}
}