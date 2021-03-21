<?php
namespace Rasty\Crud\pages\entities;

use Rasty\components\RastyPage;

use Rasty\utils\XTemplate;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

/**
 * Página para consultar entities
 * 
 * @author Bernardo
 * @since 11/08/2015
 *
 */
abstract class EntitiesList extends RastyPage{

	
	public function getType(){
		return "EntitiesList";
	}
	
	protected abstract function getFilterType();
	
	protected abstract function getModelClazz();

	protected abstract function getUicriteriaClazz();
	
	protected abstract function getLegend();
	
	protected abstract function getLegendAgain();
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		
		$componentConfig = new ComponentConfig();
	    $componentConfig->setId( "entitiesFilter" );
		$componentConfig->setType( $this->getFilterType() );
		
		//$xtpl->assign("filter", "dddd");
		
		//esto setearlo en el .rasty
	    $filter = ComponentFactory::buildByType($componentConfig, $this);
	    $filter->setGridModelClazz( $this->getModelClazz());
	    $filter->setUicriteriaClazz( $this->getUicriteriaClazz() );
	    $filter->setLegend( $this->getLegend() );
	    $filter->setLegendAgain( $this->getLegendAgain() );
	    $filter->setResultDiv( "searchdiv" );
	    
	    $xtpl->assign("filter", $filter->render());
		
	}

}
?>