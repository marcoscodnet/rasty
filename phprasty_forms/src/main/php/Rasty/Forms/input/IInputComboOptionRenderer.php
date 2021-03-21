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
interface IInputComboOptionRenderer{

	function renderOption(XTemplate $xtpl, $label, $value, $selected );
	
	function renderEntityOption(XTemplate $xtpl, $finder, $entity, $selected );

}
?>