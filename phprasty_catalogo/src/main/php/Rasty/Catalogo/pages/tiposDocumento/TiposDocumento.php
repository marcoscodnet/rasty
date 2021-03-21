<?php
namespace Rasty\Catalogo\pages\tiposDocumento;

use Rasty\Catalogo\conf\RastyCatalogoConfig;

use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\Catalogo\components\grid\model\TipoDocumentoGridModel;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\Crud\pages\entities\EntitiesList;


class TiposDocumento extends EntitiesList{

	
	public function getLayoutType(){
		
		return RastyCatalogoConfig::getInstance()->getLayoutType();
	}

	protected function getFilterType(){
		return "TipoDocumentoFilter";
	}
	
	protected function getModelClazz(){
		return get_class( new TipoDocumentoGridModel() );
	}

	protected function getUicriteriaClazz(){
		return get_class( new UICatalogoCriteria() );
	}
	
	protected function getLegend(){
		return $this->localize("tiposDocumento.buscar");
	}
	
	
	protected function getLegendAgain(){
		return $this->localize("tiposDocumento.buscar");
	}
	
	
	public function getTitle(){
		return $this->localize( "tiposDocumento.title" );
	}

	public function getMenuGroups(){

		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "tiposDocumento.agregar") );
		$menuOption->setPageName("TipoDocumentoAdd");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}

}
?>