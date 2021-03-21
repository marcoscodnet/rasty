<?php

namespace Rasty\Menu\menu\model;

use Rasty\utils\LinkBuilder;

/**
 * menu option a un link.
 * 
 * @author bernardo
 * @since 05-12-2013
 *
 */
class MenuLinkOption extends MenuOption{

	
	/**
	 * link a consultar
	 * @var string
	 */	
	private $link;
	
	/**
	 * (non-PHPdoc)
	 * @see menu/model/Rasty\Menu\menu\model.MenuOption::getLink()
	 */
	public function getLink(){
		return $link;
	}


	public function setLink($link)
	{
	    $this->link = $link;
	}
}