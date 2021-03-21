<?php
namespace Rasty\Geo\pages\localidades;

use Rasty\Geo\components\grid\model\LocalidadGridModel;

use Rasty\Geo\components\filter\model\UILocalidadCriteria;

use Cose\Geo\model\Localidad;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;

class Localidades  extends EntitiesList{

	
	public function getLayoutType(){
		
		return "GeoLayout";
	}

	protected function getFilterType(){
		return "LocalidadFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new LocalidadGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UILocalidadCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("localidades.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("localidades.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "localidades.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "localidades.agregar") );
		$menuOption->setPageName("LocalidadAdd");
		$provinciaOid = RastyUtils::getParamGET("provinciaOid");
		if(!empty($provinciaOid)){
			$menuOption->addParam("provinciaOid", $provinciaOid);
		}
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>