<?php
namespace Rasty\Workflow\components\grid\formats;


use Rasty\Workflow\utils\RastyWkfUtils;

use Cose\Workflow\model\EstadoTarea;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el tipo de una Tarea
 *
 * @author Bernardo
 * @since 03-09-2015
 *
 */

class GridTipoTareaFormat extends  GridValueFormat{

	private $pattern;
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return  Locale::localize($value->getNombre());
		else $value;	
	}		
	
//	public function getColumnCssClass($value, $item=null){
//	
//		return RastyWkfUtils::getEstadoTareaCss($value);
//	}
	
	public function getPattern(){
		return $this->pattern;
	}
	
}