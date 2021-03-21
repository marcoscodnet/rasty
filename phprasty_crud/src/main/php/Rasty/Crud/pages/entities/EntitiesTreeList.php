<?php
namespace Rasty\Crud\pages\entities;

use Rasty\components\RastyPage;

use Rasty\utils\XTemplate;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

/**
 * Página para consultar entities en formato de tree
 * 
 * @author Bernardo
 * @since 03/09/2015
 *
 */
abstract class EntitiesTreeList extends RastyPage{

	
	public function getType(){
		return "EntitiesTreeList";
	}
	
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_resultados", $this->getTitle() );
		
		
	}

}
?>