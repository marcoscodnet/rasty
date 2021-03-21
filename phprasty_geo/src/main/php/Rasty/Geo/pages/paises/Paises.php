<?php
namespace Rasty\Geo\pages\paises;

use Rasty\Geo\components\grid\model\PaisGridModel;

use Rasty\Geo\components\filter\model\UIPaisCriteria;

use Cose\Geo\model\Pais;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;

class Paises  extends EntitiesList{

	
	public function getLayoutType(){
		
		return "GeoLayout";
	}

	protected function getFilterType(){
		return "PaisFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new PaisGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UIPaisCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("paises.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("paises.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "paises.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "paises.agregar") );
		$menuOption->setPageName("PaisAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>