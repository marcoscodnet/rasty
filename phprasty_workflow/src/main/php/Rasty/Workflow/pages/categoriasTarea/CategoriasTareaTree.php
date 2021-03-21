<?php
namespace Rasty\Workflow\pages\categoriasTarea;

use Rasty\Workflow\components\grid\model\CategoriaTareaTreeGridModel;

use Rasty\Workflow\components\grid\model\CategoriaTareaGridModel;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Microjuris\Catalogo\Core\model\CategoriaTarea;


use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesTreeList;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

class CategoriasTareaTree extends EntitiesTreeList{

	
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}

	protected function getFilterType(){
		return "CategoriaTareaFilter";
	}
	
	public function getGridModel(){
		return new CategoriaTareaTreeGridModel();
	}
	
	protected function getModel(){
		return new CategoriaTareaTreeGridModel();
	}

	protected function getUicriteriaClazz(){
		return get_class( new UICatalogoCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("categoriasTarea.buscar.legend");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("categoriasTarea.buscar.legend");
	}
	
	
	public function getTitle(){
		return $this->localize( "categoriasTarea.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "categoriasTarea.agregar") );
		$menuOption->setPageName("CategoriaTareaAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>