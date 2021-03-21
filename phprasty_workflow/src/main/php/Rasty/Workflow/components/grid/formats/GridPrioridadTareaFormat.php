<?php
namespace Rasty\Workflow\components\grid\formats;


use Rasty\Workflow\utils\RastyWkfUtils;

use Cose\Workflow\model\PrioridadTarea;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar la prioridad de una Tarea
 *
 * @author Bernardo
 * @since 04-09-2015
 *
 */

class GridPrioridadTareaFormat extends  GridValueFormat{

	private $pattern;
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return  RastyWkfUtils::getPrioridadTareaLabel($value);
		else $value;	
	}		
	
//	public function getColumnCssClass($value, $item=null){
//	
//		return RastyWkfUtils::getPrioridadTareaCss($value);
//	}
	
	public function getPattern(){
		return $this->pattern;
	}
	
}