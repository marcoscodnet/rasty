<?php

namespace Rasty\Menu\contextMenu;

use Rasty\Menu\menu\Menu;

use Rasty\Menu\menu\model\MenuGroup;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\XTemplate;
use Rasty\utils\ReflectionUtils;
use Rasty\utils\LinkBuilder;
/**
 * componente Context menu.
 * 
 * @author bernardo
 * @since 15-09-2013
 *
 */
class ContextMenu extends Menu{

	
	public function __construct(){
	
		parent::__construct();
		
	}

	public function getType(){
	
		return "ContextMenu";
		
	}

}