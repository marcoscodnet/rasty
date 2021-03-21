<?php

namespace Rasty\Menu\menu\model;

/**
 * menu group.
 * 
 * @author bernardo
 * @since 15-08-2013
 *
 */
class MenuGroup{

	/**
	 * label del menú.
	 * @var string
	 */
	private $label;
	
	/**
	 * orden del menu group en el menú.
	 * @var int
	 */
	private $order;
	
	/**
	 * opciones del menú
	 * @var array [MenuOption]
	 */
	private $menuOptions;
	
	
	public function __construct(){

		$this->menuOptions = array();
	}
	
	public function getLabel()
	{
	    return $this->label;
	}

	public function setLabel($label)
	{
	    $this->label = $label;
	}

	public function getOrder()
	{
	    return $this->order;
	}

	public function setOrder($order)
	{
	    $this->order = $order;
	}

	public function getMenuOptions()
	{
	    return $this->menuOptions;
	}

	public function setMenuOptions($menuOptions)
	{
	    $this->menuOptions = $menuOptions;
	}
	
	public function addMenuOption(MenuOption $menuOption){
		
		$order = $menuOption->getOrder();
		if( !empty($order) )
			$this->menuOptions[$order] = $menuOption;
		else			
			$this->menuOptions[] = $menuOption;
	}
	
	
	
}