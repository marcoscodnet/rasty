<?php

namespace Rasty\Menu\menu\model;

use Rasty\utils\LinkBuilder;

/**
 * menu option a una función javascript.
 * 
 * @author bernardo
 * @since 05-12-2013
 *
 */
class MenuJavascriptOption extends MenuOption{

	
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
		return $this->link;
	}


	public function setLink($link)
	{
	    $this->link = $link;
	}
	
	public function getOnclick(){
		return  $this->getLink() . ";return false";
	}
}