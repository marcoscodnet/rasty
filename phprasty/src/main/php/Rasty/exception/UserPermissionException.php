<?php

namespace Rasty\exception;
/**
 * Excepción para usuario cuando no tiene
 * los permisos requeridos.
 * 
 * @author bernardo
 * @since 22-01-2015
 */
use Rasty\i18n\Locale;

class UserPermissionException extends RastyException{
	
	public function __construct($msg=""){

		if(empty($msg))
			$msg = Locale::localize("user.permission.exception.msg");
		
		parent::__construct($msg);
	}
	
}
