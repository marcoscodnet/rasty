<?php
namespace Rasty\Catalogo\pages\estadosCivil;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\Catalogo\components\grid\model\EstadoCivilGridModel;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;


class EstadosCivil extends EntitiesList{

	
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}

	protected function getFilterType(){
		return "EstadoCivilFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new EstadoCivilGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UICatalogoCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("estadosCivil.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("estadosCivil.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "estadosCivil.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "estadosCivil.agregar") );
		$menuOption->setPageName("EstadoCivilAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>