<?php
namespace Rasty\Catalogo\components\grid\model;


use Rasty\Catalogo\components\filter\model\UICatalogoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\Grid\entitygrid\model\GridDatetimeFormat;


use Rasty\factory\PageFactory;
use Rasty\security\RastySecurityContext;

use Rasty\exception\UserPermissionException;
use Rasty\exception\UserRequiredException;


/**
 * Model para la grilla de Catalogo.
 * 
 * @author Bernardo
 * @since 14/08/2015
 */
abstract class CatalogoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
   public function getFilter(){
    	
    	$filter = new UICatalogoCriteria();
		return $filter;    	
    }

    public function getEntityId( $anObject ){
			
		return  $anObject->getOid();
			
	}

	protected function getCodigoLabel(){
		return "catalogo.codigo";
	}
	
	protected function getNombreLabel(){
		return "catalogo.nombre";
	}
	 
	protected function initModel() {
		
		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "codigo", $this->getCodigoLabel(), 30, EntityGrid::TEXT_ALIGN_CENTER) ;
		$column->setCssClass("no-phone");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "nombre", $this->getNombreLabel(), 40, EntityGrid::TEXT_ALIGN_LEFT) ;
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
	
		
		if( $this->getUpdatePageName() ){

			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( $this->getUpdateLabel() ) );
			$menuOption->setPageName( $this->getUpdatePageName() );
			$menuOption->addParam("oid",$item->getOid());
			$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
			
			$options = $this->addMenuOption($menuOption, $options);
			
		}
		
		if( $this->getViewPageName() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( $this->getViewLabel() ) );
			$menuOption->setPageName( $this->getViewPageName() );
			$menuOption->addParam("oid",$item->getOid());
			$menuOption->setImageSource( $this->getWebPath() . "css/images/view_32.png" );
			$options = $this->addMenuOption($menuOption, $options);
		}
		
		if( $this->getDeletePageName() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( $this->getDeleteLabel() ) );
			$menuOption->setPageName( $this->getDeletePageName() );
			$menuOption->addParam("oid",$item->getOid());
			$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
			$options = $this->addMenuOption($menuOption, $options);
		}
		
		$group->setMenuOptions( $options );
		
		return array( $group );
		
	}

	protected function getViewPageName(){
		return "";
	}

	protected function getUpdatePageName(){
		return "";
	}
	
	protected function getDeletePageName(){
		return "";
	}
    
	protected function getUpdateLabel(){
		return "menu.catalogo.modificar";
	}
	
	protected function getDeleteLabel(){
		return "menu.catalogo.eliminar";
	}
	
	protected function getViewLabel(){
		return "menu.catalogo.consultar";
	}
	
	
	/**
	 * chequea si el usuario logueado tiene acceso a una página
	 * @param string $pageName
	 */
	public function tienePermisoAPagina($pageName){

		//si tiene permisos agrego el menú.
		$page = PageFactory::build( $pageName );
		
		try {

			RastySecurityContext::authorize($page);
			return true;				
			
		} catch (UserRequiredException $e) {
			
		} catch (UserPermissionException $e) {
			
		}
		
		return false;
			
	}
	
	public function addMenuOption(MenuOption $menuOption, $options){

		//si tiene permisos agrego el menú.
		if( $this->tienePermisoAPagina( $menuOption->getPageName() )){
			$options[] = $menuOption ;
		}
		
		return $options;
			
	}
	
}
?>