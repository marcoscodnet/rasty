<?php
namespace Rasty\Workflow\pages\tareas;

use Rasty\Workflow\conf\RastyWkfConfig;

use Rasty\Workflow\components\grid\model\TareaGridModel;

use Rasty\Workflow\components\filter\model\UITareaCriteria;

use Cose\Workflow\model\Tarea;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;

class Tareas  extends EntitiesList{

	
	public function getLayoutType(){
		
		return RastyWkfConfig::getInstance()->getLayoutType();
	}

	protected function getFilterType(){
		return "TareaFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new TareaGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UITareaCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("tareas.buscar.legend");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("tareas.buscar.legend");
	}
	
	
	public function getTitle(){
		return $this->localize( "tareas.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "tareas.agregar") );
		$menuOption->setPageName("TareaAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>