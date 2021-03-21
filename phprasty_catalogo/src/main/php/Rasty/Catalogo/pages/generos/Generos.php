<?php
namespace Rasty\Catalogo\pages\generos;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\Catalogo\components\grid\model\GeneroGridModel;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;


class Generos extends EntitiesList{

	
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}

	protected function getFilterType(){
		return "GeneroFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new GeneroGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UICatalogoCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("generos.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("generos.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "generos.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "generos.agregar") );
		$menuOption->setPageName("GeneroAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>