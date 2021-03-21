<?php
namespace Rasty\Forms\input;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

/**
 * Renderer para una option de un select
 * 
 * @author bernardo
 * @since 10/02/2015
 */
class DefaultInputComboOptionRenderer implements IInputComboOptionRenderer{


	function renderOption(XTemplate $xtpl, $label, $value, $selected ){
		
		$xtpl->assign( "label", $label );
	    $xtpl->assign( "value", RastyUtils::selected( $value, $selected) );
	    $xtpl->parse( "main.option" );
		
	}
	
	function renderEntityOption(XTemplate $xtpl, $finder, $entity, $selected ){
		
		$label = $finder->getEntityLabel($entity);
	    $value = $finder->getEntityCode($entity);
	    $xtpl->assign( "label", $label );
	    $xtpl->assign( "value", RastyUtils::selected( $value, $selected) );
	    $xtpl->parse( "main.option" );
		
	}
}
?>