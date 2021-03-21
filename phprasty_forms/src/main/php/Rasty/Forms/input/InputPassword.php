<?php
namespace Rasty\Forms\input;

use Rasty\Forms\form\DefaultPropertyFormatter;
/**
 * Input para passwords

 * @author bernardo
 * @since 20/11/2014
 */
class InputPassword extends InputText{

public function __construct(){
		
		$this->setFormatterClazz( get_class(new DefaultPropertyFormatter()) );
	}
	
	public function getType(){
		
		return "InputPassword";
	}
	
}
?>