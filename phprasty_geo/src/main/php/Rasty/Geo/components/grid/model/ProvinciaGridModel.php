<?php
namespace Rasty\Geo\components\grid\model;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Geo\utils\RastyGeoUtils;

use Rasty\Geo\components\filter\model\UIProvinciaCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;

use Rasty\utils\RastyUtils;

/**
 * Model para la grilla de Provincia.
 *
 * @author Bernardo
 * @since 20/08/2015
 */
class ProvinciaGridModel extends EntityGridModel{

	public function __construct() {

		parent::__construct();
		$this->initModel();

	}

	public function getService(){
			
		return UIServiceFactory::getUIProvinciaService();
	}


	public function getFilter(){
		 
		$filter = new UIProvinciaCriteria();
		return $filter;
	}

	public function getEntityId( $anObject ){
			
		return $anObject->getOid();
			
	}

	protected function getCodigoLabel(){
		return "provincia.codigo";
	}

	protected function getNombreLabel(){
		return "provincia.nombre";
	}

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "codigo", $this->getCodigoLabel(), 30, EntityGrid::TEXT_ALIGN_CENTER) ;
		$column->setCssClass("no-phone");
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "nombre", $this->getNombreLabel(), 40, EntityGrid::TEXT_ALIGN_LEFT) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "pais", "provincia.pais", 40, EntityGrid::TEXT_ALIGN_LEFT) ;
		$this->addColumn( $column );

	}

	public function getDefaultFilterField() {
		return "nombre";
	}

	public function getDefaultOrderField(){
		return "nombre";
	}

	public function getDefaultOrderType(){
		return "DESC";
	}


	/**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){

		
		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		$paisOid = $item->getPais()->getOid();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( $this->getUpdateLabel() ) );
		$menuOption->setPageName( $this->getUpdatePageName() );
		$menuOption->addParam("oid",$item->getOid());
		if(!empty($paisOid))
			$menuOption->addParam("paisOid",$paisOid);
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options = RastyGeoUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( $this->getViewLabel() ) );
		$menuOption->setPageName( $this->getViewPageName() );
		$menuOption->addParam("oid",$item->getOid());
		if(!empty($paisOid))
			$menuOption->addParam("paisOid",$paisOid);
		$menuOption->setImageSource( $this->getWebPath() . "css/images/view_32.png" );
		$options = RastyGeoUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( $this->getDeleteLabel() ) );
		$menuOption->setPageName( $this->getDeletePageName() );
		$menuOption->addParam("oid",$item->getOid());
		if(!empty($paisOid))
			$menuOption->addParam("paisOid",$paisOid);
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options = RastyGeoUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.provincias.localidades" ) );
		$menuOption->setPageName( "Localidades" );
		$menuOption->addParam("provinciaOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/localidades_32.png" );
		$options = RastyGeoUtils::addMenuOption($menuOption, $options);
				
		$group->setMenuOptions( $options );

		return array( $group );

	}

	protected function getViewPageName(){
		return "ProvinciaView";
	}

	protected function getUpdatePageName(){
		return "ProvinciaUpdate";
	}

	protected function getDeletePageName(){
		return "ProvinciaDelete";
	}

	protected function getUpdateLabel(){
		return "menu.provincia.modificar";
	}

	protected function getDeleteLabel(){
		return "menu.provincia.eliminar";
	}

	protected function getViewLabel(){
		return "menu.provincia.consultar";
	}

}
?>