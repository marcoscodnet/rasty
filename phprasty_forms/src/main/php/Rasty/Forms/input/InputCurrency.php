<?php
namespace Rasty\Forms\input;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\Logger;
use Rasty\Forms\form\NumberPropertyFormatter;

/**
 * Input para InputCurrency

 * @author bernardo
 * @since 13/03/2015
 */
class InputCurrency extends InputNumber{

	public function __construct(){
		//parent::__construct();
		
		$this->setInvalidFormatMessage( $this->localize("currency.format.invalid") );
	}
	
	function getStyleCss(){
		
		return " input-currency " .parent::getStyleCss();
	} 

}
?>