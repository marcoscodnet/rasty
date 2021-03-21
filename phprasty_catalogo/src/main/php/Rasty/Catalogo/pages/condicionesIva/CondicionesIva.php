<?php
namespace Rasty\Catalogo\pages\condicionesIva;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\Catalogo\components\grid\model\CondicionIvaGridModel;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;


class CondicionesIva extends EntitiesList{

	
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}

	protected function getFilterType(){
		return "CondicionIvaFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new CondicionIvaGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UICatalogoCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("condicionesIva.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("condicionesIva.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "condicionesIva.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "condicionesIva.agregar") );
		$menuOption->setPageName("CondicionIvaAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>