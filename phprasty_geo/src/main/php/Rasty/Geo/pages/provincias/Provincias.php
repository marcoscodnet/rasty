<?php
namespace Rasty\Geo\pages\provincias;

use Rasty\Geo\components\grid\model\ProvinciaGridModel;

use Rasty\Geo\components\filter\model\UIProvinciaCriteria;

use Cose\Geo\model\Provincia;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;

class Provincias  extends EntitiesList{

	
	public function getLayoutType(){
		
		return "GeoLayout";
	}

	protected function getFilterType(){
		return "ProvinciaFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new ProvinciaGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UIProvinciaCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("provincias.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("provincias.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "provincias.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "provincias.agregar") );
		$menuOption->setPageName("ProvinciaAdd");
		$paisOid = RastyUtils::getParamGET("paisOid");
		if(!empty($paisOid)){
			$menuOption->addParam("paisOid", $paisOid);
		}
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>