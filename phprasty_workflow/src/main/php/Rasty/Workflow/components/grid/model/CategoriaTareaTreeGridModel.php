<?php
namespace Rasty\Workflow\components\grid\model;


use Rasty\Workflow\components\filter\model\UICategoriaTareaCriteria;

use Rasty\Workflow\components\grid\formats\GridTipoTareaFormat;

use Rasty\Workflow\components\grid\formats\GridEstadoTareaFormat;

use Rasty\Workflow\utils\RastyWkfUtils;

use Rasty\Workflow\components\grid\formats\GridEstadoEstadoTareaFormat;

use Rasty\Workflow\components\filter\model\UITareaCriteria;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Grid\entitytreegrid\EntityTreeGrid;
use Rasty\Grid\entitytreegrid\model\EntityTreeGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;

use Rasty\Grid\entitygrid\model\GridDatetimeFormat;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;


use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;
/**
 * Model para la grilla de CategoriaTarea.
 * 
 * @author bernardo
 * @since 02/09/2015
 * 
 */


class CategoriaTareaTreeGridModel extends EntityTreeGridModel{


	public function __construct() {

		parent::__construct();
		$this->initModel();

	}

	public function getChildren($entity=null){

		$criteria = new UICategoriaTareaCriteria();
		
		if($entity == null ){

			$criteria->setPadreIsNull(true);
			
		}else{
			$criteria->setPadre( $entity );
		}
		
		
		return $this->getService()->getEntities( $criteria );
		
	}
	
	public function getService(){
			
		return UIServiceFactory::getUICategoriaTareaService();
	}

	public function getFilter(){

		$filter = new UICatalogoCriteria();
		return $filter;
	}

	public function getEntityId( $anObject ){
			
		return $anObject->getOid();
			
	}

	public function getEntityLabel( $anObject ){
			
		return $anObject;
			
	}
	
	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "codigo", "catalogo.codigo", 40, EntityTreeGrid::TEXT_ALIGN_CENTER  );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "nombre", "catalogo.nombre", 40, EntityTreeGrid::TEXT_ALIGN_LEFT  );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "descripcion", "catalogo.descripcion", 40, EntityTreeGrid::TEXT_ALIGN_LEFT);
		$this->addColumn( $column );
		
	}

	public function getDefaultFilterField() {
		return "codigo";
	}

	public function getDefaultOrderField(){
		return "codigo";
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
		$menuOption->setLabel( $this->localize( "menu.categoriaTarea.agregarHijo" )  . " " . $item);
		$menuOption->setPageName( "CategoriaTareaAdd" );
		$menuOption->addParam("padre",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.catalogo.modificar" )  . " " . $item);
		$menuOption->setPageName( "CategoriaTareaUpdate" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.catalogo.consultar" )  . " " . $item );
		$menuOption->setPageName( "CategoriaTareaView" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/view_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.catalogo.eliminar" )   . " " . $item);
		$menuOption->setPageName( "CategoriaTareaDelete" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options = RastyWkfUtils::addMenuOption($menuOption, $options);

		$group->setMenuOptions( $options );

		return array( $group );
		
	}
	    
}
?>