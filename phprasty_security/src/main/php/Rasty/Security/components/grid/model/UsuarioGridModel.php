<?php
namespace Rasty\Security\components\grid\model;

use Rasty\Security\service\finder\UsuarioFinder;

use Rasty\Security\components\filter\model\UIUsuarioCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Rasty\Security\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

use Rasty\Grid\entitygrid\model\GridDatetimeFormat;

/**
 * Model para la grilla de Usuario.
 * 
 * @author Bernardo
 * @since 06/11/2014
 */
class UsuarioGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIUsuarioService();
    }
    
    public function getFilter(){
    	
    	$filter = new UIUsuarioCriteria();
    	
		return $filter;    	
    }


    public function getEntityId( $anObject ){
			
    	$finder = new UsuarioFinder();
		return  $finder->getEntityCode( $anObject );
			
	}
	
	protected function initModel() {
		
		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "usuario.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$column->setCssClass("no-phone");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "username", "usuario.username", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "name", "usuario.name", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$column->setCssClass("no-phone");
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "lastname", "usuario.lastname", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$column->setCssClass("no-phone");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "email", "usuario.email", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "lastLogin", "usuario.lastLogin", 30, EntityGrid::TEXT_ALIGN_LEFT, new GridDatetimeFormat("d/m/Y H:i:s") ) ;
		$this->addColumn( $column );
		
//		$column = GridModelBuilder::buildColumn( "loginFrom", "usuario.loginFrom", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
//		$column->setCssClass("no-phone");
//		$this->addColumn( $column );
		
	}

	public function getDefaultFilterField() {
        return "username";
    }

	public function getDefaultOrderField(){
		return "username";
	}    

	public function getDefaultOrderType(){
		return "ASC";
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
		$menuOption->setLabel( $this->localize( "menu.usuarios.modificar") );
		$menuOption->setPageName( "UsuarioModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-editar" );
		$options[] = $menuOption ;
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios.asignarRoles") );
		$menuOption->setPageName( "RolAsignar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-roles" );
		$options[] = $menuOption ;
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios.consultarRoles") );
		$menuOption->setPageName( "RolConsultar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-consultar" );
		$options[] = $menuOption ;
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.usuarios.eliminar") );
		$menuOption->setPageName( "UsuarioEliminar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setIconClass( "icon-remove" );
		$options[] = $menuOption ;
		
		$group->setMenuOptions( $options );
		
		return array( $group );
		
	} 
    
}
?>