<?php
namespace Rasty\Grid\entitygrid\model;


/**
 * Formato para renderizar una fecha en la grilla
 *
 * @author Bernardo
 * @since 28-05-2014
 *
 */

class GridDatetimeFormat extends GridValueFormat{

	private $pattern;
	
	public function __construct( $pattern ){
		$this->pattern = $pattern;
	}
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return $value->format( $this->getPattern() );
		else $value;	
	}		
	
	public function getPattern(){
		return $this->pattern;
	}
	
}