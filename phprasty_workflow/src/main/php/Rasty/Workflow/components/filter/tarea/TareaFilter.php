<?php

namespace Rasty\Workflow\components\filter\tarea;

use Rasty\Workflow\service\UIServiceFactory;

use Rasty\Workflow\components\filter\model\UITareaCriteria;

use Rasty\Workflow\components\grid\model\TareaGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filter para Tarea
 * 
 * @author Bernardo
 * @since 02/09/2015
 */
class TareaFilter extends Filter{
		
	
	public function getType(){
		
		return "TareaFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new TareaGridModel() ) );
		
		$this->setUicriteriaClazz( get_class( new UITareaCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		$this->addProperty("filtroPredefinido");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_fechaDesde",  $this->localize("tarea.fechaDesde") );
		$xtpl->assign("lbl_fechaHasta",  $this->localize("tarea.fechaHasta") );
			
		$xtpl->assign("lbl_predefinidos",  $this->localize("criteria.predefinidos") );
		
		
	}
	
	public function getFiltrosPredefinidos(){
		
		$items = array();
		
		$items[ UITareaCriteria::MISPENDIENTES] = $this->localize("tarea.filter.mispendientes");
		$items[ UITareaCriteria::PENDIENTES] = $this->localize("tarea.filter.pendientes");
		$items[ UITareaCriteria::SEMANA_ACTUAL] = $this->localize("tarea.filter.semanaactual");
		
		
		return $items;
		
	}
		
}
?>