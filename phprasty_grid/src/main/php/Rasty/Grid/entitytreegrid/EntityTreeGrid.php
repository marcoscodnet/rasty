<?php
namespace Rasty\Grid\entitytreegrid;

use Rasty\Grid\entitygrid\model\GridActionModel;
use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;
use Rasty\utils\ReflectionUtils;
use Rasty\utils\Logger;
use Rasty\utils\XTemplate;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\i18n\Locale;
use Rasty\app\RastyMapHelper;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\exception\RastyException;

/**
 * componente grilla tipo tree para entities.
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 03-09-2015
 *
 */
class EntityTreeGrid extends RastyComponent{

	const TEXT_ALIGN_CENTER = 1;
	const TEXT_ALIGN_LEFT = 2;
	const TEXT_ALIGN_RIGHT = 3;
	
	/**
	 * modelo de la grilla
	 * @var EntityTreeGridModel
	 */
	private $model;
	
	private $menuType = "Menu";
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("gridId", $this->getId() );	
		
		$this->renderRowsHeader( $xtpl );
		
		$this->renderRows($xtpl);
	}

	public function getType(){
		return "EntityTreeGrid";
	}

	public function renderRowsHeader( XTemplate $xtpl) {

    	$gridId = $this->getId();
    	$model = $this->getModel();
    	
    	//parseamos el primer nivel de headers.
        for ($index = 0; $index < $model->getColumnCount(); $index++) {
        	
        	$oColumnModel = $model->getColumnModel($index);
        	
           	$label = Locale::localize($oColumnModel->getLabel() );
			$cssClass = $oColumnModel->getCssClass();
				
       		$xtpl->assign('column_header_class', $cssClass);
       		$xtpl->assign('label', $label);
	            
       		$xtpl->parse('main.TH');
        		
		}
		
    }
	

    public function renderRows(XTemplate $xtpl) {

        $model = $this->getModel();
		$tree = $model->getTree();
        
		
//    	$entities = array( 
//    					array("1","Root 1", "colum data 1", "colum data 2", "colum data 3"),
//    					array("2","Hijo 1", "colum data 1", "colum data 2", "colum data 3"),
//    					array("2","Hijo 2", "colum data 1", "colum data 2", "colum data 3"),
//    					array("2","Hijo 3", "colum data 1", "colum data 2", "colum data 3"),
//    					array("3","Nieto 3.1", "colum data 1", "colum data 2", "colum data 3"),
//    					array("3","Nieto 3.2", "colum data 1", "colum data 2", "colum data 3"),
//    					array("1","Root 2", "colum data 1", "colum data 2", "colum data 3"),
//    					);

        foreach ($tree as $item) {
            $this->renderRow($item, $xtpl);
        }
    }

    public function renderRow($item, XTemplate $xtpl) {


        $model = $this->getModel();

    	$level = $item[0];
    	$entity = $item[1];
    	
        //parseamos el id.
        $itemId = str_replace(".", "_", $model->getEntityId($entity));
		$xtpl->assign('itemId', $itemId );
	
		$xtpl->assign('data_level', $level );

		$xtpl->assign('treelabel', $entity);
		
		
        for ($index = 0; $index < $model->getColumnCount(); $index++) {
			
        	$this->renderColumn( $entity, $index, $xtpl);
        	
        }

        
        //$xtpl->assign('row_class', $model->getRowStyleClass($item));
        
        $this->renderRowActions($entity, $xtpl);
        
        $xtpl->parse('main.row');
    }
    
    public function renderColumn( $item, $index, XTemplate $xtpl) {
    	
    	$model = $this->getModel();
    	
    	$oColumnModel = $model->getColumnModel($index);

        $value = $model->getValue($item, $index);

        $cssClass = $oColumnModel->getCssClass();
        
        $cssClass .= " " . $oColumnModel->getFormat()->getColumnCssClass($value, $item); 
        
        $cssStyle = $oColumnModel->getCssStyle();

       $value = $oColumnModel->getFormat()->format($value, $item);
        
        $textAlign = $oColumnModel->getTextAlign();
        
        if(!empty($textAlign)){
        
        	switch ($textAlign) {
        		case self::TEXT_ALIGN_CENTER: $cssStyle .= ";text-align:center;";
        		;break;
        		case self::TEXT_ALIGN_LEFT: $cssStyle .= ";text-align:left;";
        		;break;
        		case self::TEXT_ALIGN_RIGHT: $cssStyle .= ";text-align:right;";
        		;break;
        		default: "";
        			;
        		break;
        	}
        
        }
        
        $xtpl->assign('column_class', $cssClass);
        $xtpl->assign('column_style', $cssStyle);
        $xtpl->assign('value', $value);
        
        $xtpl->parse('main.row.column');
    }
    

	public function getModel()
	{
	    return $this->model;
	}

	public function setModel($model)
	{
	    $this->model = $model;
	}
	
		
	public function renderRowActions( $item, XTemplate $xtpl) {

    	$model = $this->getModel();
        
        $itemId = (!empty($item))?$model->getEntityId($item): "";

        //armamos un menú con las opciones (si es que hay)
        //para el item.
        $menuGroups = $model->getMenuGroups($item);
        
        if( count($menuGroups) > 0 ){
	        
	        //generamos el menu a partir del type.
		    $componentConfig = new ComponentConfig();
		    $componentConfig->setId( "menu_$itemId" );
		    
		    $menuType = $this->getMenuType();
		    if(empty($menuType))
		    	$menuType = "Menu";
			$componentConfig->setType( $menuType );
			
		    $menu = ComponentFactory::buildByType($componentConfig, $this);
	        $menu->setMenuGroups($menuGroups);
	        //$menu->setLabel("test");
	        $xtpl->assign("actions", $menu->render());
	    	$xtpl->parse("main.row.row_actions");    	
        }
        
        
    }
    
	

	public function getMenuType()
	{
	    return $this->menuType;
	}

	public function setMenuType($menuType)
	{
	    $this->menuType = $menuType;
	}
}