<?php
namespace Rasty\Forms\input;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\Logger;
/**
 * Input para fechas

 * @author bernardo
 * @since 07/08/2013
 */
class InputDateMask extends InputText{

	
	/**
	 * para editar el mes
	 * @var boolean
	 */
	private $changeMonth;

	/**
	 * para editar el anio
	 * @var boolean
	 */
	private $changeYear;
		
	/**
	 * fecha por default.
	 * @var string.
	 */
	private $defaultDate;

	/**
	 * cantidad e meses a visualizar.
	 * @var int
	 */
	private $numberOfMonths;
	
	private $maxDate;
	
	private $minDate;


	protected function parseXTemplate(XTemplate $xtpl){

		
		parent::parseXTemplate($xtpl);
		
		if( $this->getChangeMonth() )
    		$xtpl->assign("changeMonth", "true" );    		
    	else 
    		$xtpl->assign("changeMonth", "false" );
    	
    	if( $this->getChangeYear() )
    		$xtpl->assign("changeYear", "true" );    		
    	else 
    		$xtpl->assign("changeYear", "false" );
    	
    		
   		$xtpl->assign("defaultDate", $this->getDefaultDate() );    		
   		$xtpl->assign("numberOfMonths", $this->getNumberOfMonths() );    		
   		
   		
   		$maxDate = $this->getMaxDate();
   		if(!empty($maxDate)){
   			
			$value = str_replace('/', '-', $maxDate);
			$time = strtotime($value);
			
			$maxYear = date("Y", $time);
			$maxMonth = date("m", $time) - 1;
			$maxDay = date("d", $time);
			$maxDate = ",maxDate: new Date($maxYear, $maxMonth, $maxDay)";
			
   			$xtpl->assign("maxDate", $maxDate );
   			
   		}
   		
	   	$minDate = $this->getMinDate();
   		if(!empty($minDate)){
   			
			$value = str_replace('/', '-', $minDate);
			$time = strtotime($value);
			
			$minYear = date("Y", $time);
			$minMonth = date("m", $time) - 1;
			$minDay = date("d", $time);
			$minDate = ",minDate: new Date($minYear, $minMonth, $minDay)";
			
   			$xtpl->assign("minDate", $minDate );
   			
   		}
	}
	


	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::formatValue()
	 */
	public function formatValue( $value ){

		//Logger::log("formateando fecha $value", __CLASS__ );
		
		$res = "";
		if( !empty($value) ){
			$value = str_replace('/', '-', $value);
			$time = strtotime($value);
			//$date = new \DateTime( $time );
			//$res = $date;
			$res =  date( $this->getFormat(), $time );
			
			//Logger::log("formateando fecha res:$res", __CLASS__ );
	
			$dateTime = new \DateTime();
			$dateTime->setDate(date("Y", $time), date("m", $time), date("d", $time));
	
			//Logger::log("datetime :"  . $dateTime->format("Ymd"), __CLASS__ );
			
			return $dateTime;
		}else{
			return null;
		}
		
	}    
    
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::unformatValue()
	 */
	public function unformatValue( $value ){
		
		if(!empty($value)){
			$value = $value->format($this->getFormat());
		}
    	return $value;
    }
	
	/**
	 * (non-PHPdoc)
	 * @see input/Rasty\Forms\input.InputText::renderFormat()
	 */
    public function renderFormat(XTemplate $xtpl, $format){
	
		//pasamos el formato de fecha php al de JQuery.
		$jqueryformat = str_replace("d", "dd", $format);
		$jqueryformat = str_replace("m", "mm", $format);
		$jqueryformat = str_replace("Y", "yy", $format);
		
    	$xtpl->assign("format", $jqueryformat );
    }
	
	public function initDefaults(){

		parent::initDefaults();
		
		$this->setChangeMonth(true);
		$this->setChangeYear(true);
		$this->setDefaultDate("+1w");
		
		if(empty($this->numberOfMonths))
			$this->setNumberOfMonths(3);
		
		$this->setFormat("d/m/Y");
		
	}
	
	public function getType(){
		
		return "InputDateMask";
	}
	
	public function getChangeMonth()
	{
	    return $this->changeMonth;
	}

	public function setChangeMonth($changeMonth)
	{
	    $this->changeMonth = $changeMonth;
	}

	public function getChangeYear()
	{
	    return $this->changeYear;
	}

	public function setChangeYear($changeYear)
	{
	    $this->changeYear = $changeYear;
	}

	public function getDefaultDate()
	{
	    return $this->defaultDate;
	}

	public function setDefaultDate($defaultDate)
	{
	    $this->defaultDate = $defaultDate;
	}

	public function getNumberOfMonths()
	{
	    return $this->numberOfMonths;
	}

	public function setNumberOfMonths($numberOfMonths)
	{
	    $this->numberOfMonths = $numberOfMonths;
	}

	public function getMaxDate()
	{
	    return $this->maxDate;
	}

	public function setMaxDate($maxDate)
	{
	    $this->maxDate = $maxDate;
	}

	public function getMinDate()
	{
	    return $this->minDate;
	}

	public function setMinDate($minDate)
	{
	    $this->minDate = $minDate;
	}
}
?>