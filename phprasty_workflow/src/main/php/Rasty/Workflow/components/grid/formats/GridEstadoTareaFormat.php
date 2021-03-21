<?php
namespace Rasty\Workflow\components\grid\formats;


use Rasty\Workflow\utils\RastyWkfUtils;

use Cose\Workflow\model\EstadoTarea;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de una Tarea
 *
 * @author Bernardo
 * @since 02-09-2015
 *
 */

class GridEstadoTareaFormat extends  GridValueFormat{

	private $pattern;
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return  RastyWkfUtils::getEstadoTareaLabel($value);
		else $value;	
	}		
	
	public function getColumnCssClass($value, $item=null){
	
		return RastyWkfUtils::getEstadoTareaCss($value);
	}
	
	public function getPattern(){
		return $this->pattern;
	}
	
}