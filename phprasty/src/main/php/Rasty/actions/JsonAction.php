<?php
namespace Rasty\actions;

use Rasty\exception\RastyException;
use Rasty\components\RastyPage;
use Rasty\i18n\Locale;

/**
 * Representa una acción a ejecutarse en rasty por ajax.
 * 
 * La idea del action es que se ejecute y retorne
 * el resultado en formato json.
 * 
 * @author bernardo
 * @since 03/08/2013
 */

abstract class JsonAction{
	
	/**
	 * se ejecuta el action.
	 * @throws RastyException
	 * @return json
	 */
	public abstract function execute();
	
	public function localize($keyMessage){
		return Locale::localize( $keyMessage );
	}
	
	/**
	 * cada componente podrá redefinir este mensaje con el fin
	 * de chequear si el contexto cumple con los prerequisitos
	 * para poder ejecutarse.
	 */
	public function checkRequirementsToPerform(){
		
	}
}

?>