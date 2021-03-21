<?php
namespace Rasty\Workflow\components\grid\model;


use Rasty\Workflow\components\grid\formats\GridPrioridadTareaFormat;

use Rasty\Workflow\components\grid\formats\GridTipoTareaFormat;

use Rasty\Workflow\components\grid\formats\GridEstadoTareaFormat;

use Rasty\Workflow\utils\RastyWkfUtils;

use Rasty\Workflow\components\grid\formats\GridEstadoEstadoTareaFormat;

use Rasty\Workflow\components\filter\model\UITareaCriteria;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;

use Rasty\Grid\entitygrid\model\GridDatetimeFormat;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;

/**
 * Model para la grilla de Tarea.
 *
 * @author Bernardo
 * @since 02/09/2015
 */
class TareaGridModel extends EntityGridModel{

	public function __construct() {

		parent::__construct();
		$this->initModel();

	}

	public function getService(){
			
		return UIServiceFactory::getUITareaService();
	}

	public function getFilter(){

		$filter = new UITareaCriteria();
		return $filter;
	}

	public function getEntityId( $anObject ){
			
		return $anObject->getOid();
			
	}


	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "tarea.oid", 30, EntityGrid::TEXT_ALIGN_CENTER) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "fecha", "tarea.fecha", 40, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y")  );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "fechaVencimiento", "tarea.fechaVencimiento", 40, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y")  );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "prioridad", "tarea.prioridad", 40, EntityGrid::TEXT_ALIGN_LEFT, new GridPrioridadTareaFormat() );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "tipoTarea", "tarea.tipoTarea", 40, EntityGrid::TEXT_ALIGN_LEFT, new GridTipoTareaFormat() );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "responsable", "tarea.responsable", 40, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "estado", "tarea.estado", 40, EntityGrid::TEXT_ALIGN_CENTER, new GridEstadoTareaFormat() );
		$this->addColumn( $column );
		
	}

	public function getDefaultFilterField() {
		return "fecha";
	}

	public function getDefaultOrderField(){
		return "fecha";
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

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( $this->getUpdateLabel() ) );
		$menuOption->setPageName( $this->getUpdatePageName() );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( $this->getViewLabel() ) );
		$menuOption->setPageName( $this->getViewPageName() );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/view_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( $this->getDeleteLabel() ) );
		$menuOption->setPageName( $this->getDeletePageName() );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$group->setMenuOptions( $options );

		return array( $group );

	}

	protected function getViewPageName(){
		return "TareaView";
	}

	protected function getUpdatePageName(){
		return "TareaUpdate";
	}

	protected function getDeletePageName(){
		return "TareaDelete";
	}

	protected function getUpdateLabel(){
		return "menu.tarea.modificar";
	}

	protected function getDeleteLabel(){
		return "menu.tarea.eliminar";
	}

	protected function getViewLabel(){
		return "menu.tarea.consultar";
	}

	public function getRowStyleClass( $item ){
		$css = "grid_row_class ";
		
		if( !$item->isFinalizada() )
			$css .=  RastyWkfUtils::getPrioridadTareaCss($item->getPrioridad());
			
		return $css;
	}
	
}
?>