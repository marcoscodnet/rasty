<?php
namespace Rasty\Forms\input;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\Logger;
use Rasty\Forms\form\NumberPropertyFormatter;

/**
 * Input para números

 * @author bernardo
 * @since 14/08/2013
 */
class InputNumber extends InputText{

	private $rangeMin;
	private $rangeMax;
	private $rangeMinMsg;
	private $rangeMaxMsg;
	private $rangeMsg;
	private $decimals;
	
	public function __construct(){
		//parent::__construct();
		
		$this->setInvalidFormatMessage( $this->localize("number.format.invalid") );
	}
	
	function getStyleCss(){
		
		return " input-number " .parent::getStyleCss();
	} 
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::parseXTemplate()
	 */
	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		$this->parseProperty($xtpl, "data-number", "yes" );
		$this->parseProperty($xtpl, "data-number-msg", $this->getInvalidFormatMessage() );
		$this->parseProperty($xtpl, "data-max-length", "8" );
		
		
		if($this->getRangeMax())
			$this->parseProperty($xtpl, "data-range-max", $this->getRangeMax() );
			
		if($this->getRangeMin())
			$this->parseProperty($xtpl, "data-range-min", $this->getRangeMin() );

		if($this->getRangeMsg())
			$this->parseProperty($xtpl, "data-range-msg", $this->getRangeMsg() );
			
		if($this->getRangeMinMsg())
			$this->parseProperty($xtpl, "data-range-min-msg", $this->getRangeMinMsg() );	
			
		if($this->getRangeMaxMsg())
			$this->parseProperty($xtpl, "data-range-max-msg", $this->getRangeMaxMsg() );	
			
		if($this->getDecimals())
			$this->parseProperty($xtpl, "data-decimals", $this->getDecimals() );	
	}

	function is_empty($var, $allow_false = false, $allow_ws = false) {
	    if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {   
	        return true;
	    } else {
	        return false;
	    }
	}
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::formatValue()
	 */
	public function formatValue( $value ){

		//TODO se podría formatear en un formato específico utilizando mask

		if( $this->is_empty($value))
			return null;
		else{
			$value = str_replace(",", ".", $value);
			return $value;
		}
		return parent::formatValue($value);
	}    
    
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::unformatValue()
	 */
	public function unformatValue( $value ){
		
		$value = str_replace(",", ".", $value);
		return parent::unformatValue($value);
    }
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::renderFormat()
	 */
    public function renderFormat(XTemplate $xtpl, $format){
	
		//TODO se podría formatear en un formato específico utilizando mask
		
    }
	
	public function initDefaults(){

		parent::initDefaults();
		$this->setFormatterClazz( get_class(new NumberPropertyFormatter()) );
	}
	
	public function getType(){
		
		return "InputNumber";
	}
	

	public function getRangeMin()
	{
	    return $this->rangeMin;
	}

	public function setRangeMin($rangeMin)
	{
	    $this->rangeMin = $rangeMin;
	}

	public function getRangeMax()
	{
	    return $this->rangeMax;
	}

	public function setRangeMax($rangeMax)
	{
	    $this->rangeMax = $rangeMax;
	}

	public function getRangeMsg()
	{
	    return $this->rangeMsg;
	}

	public function setRangeMsg($rangeMsg)
	{
	    $this->rangeMsg = $rangeMsg;
	}

	public function getRangeMinMsg()
	{
	    return $this->rangeMinMsg;
	}

	public function setRangeMinMsg($rangeMinMsg)
	{
	    $this->rangeMinMsg = $rangeMinMsg;
	}

	public function getRangeMaxMsg()
	{
	    return $this->rangeMaxMsg;
	}

	public function setRangeMaxMsg($rangeMaxMsg)
	{
	    $this->rangeMaxMsg = $rangeMaxMsg;
	}

	public function getDecimals()
	{
	    return $this->decimals;
	}

	public function setDecimals($decimals)
	{
	    $this->decimals = $decimals;
	}
}
?>