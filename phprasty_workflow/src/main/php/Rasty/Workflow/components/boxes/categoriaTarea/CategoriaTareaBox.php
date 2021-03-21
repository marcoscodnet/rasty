<?php

namespace Rasty\Workflow\components\boxes\categoriaTarea;

use Rasty\Catalogo\components\boxes\catalogo\CatalogoBox;

use Rasty\utils\XTemplate;


/**
 * Box para visualizar información de una Tarea.
 * 
 * @author Bernardo
 * @since 02-09-2015
 */
class CategoriaTareaBox extends CatalogoBox{
		
	public function getType(){
		
		return "CategoriaTareaBox";
		
	}


	protected function parseLabels(XTemplate $xtpl){
		
		parent::parseLabels( $xtpl );
		
		$xtpl->assign("lbl_padre", $this->localize("categoriaTarea.padre") );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		parent::parseXTemplate($xtpl);
		
		$catalogo = $this->getCatalogo();
		
		if( !empty($catalogo) ){
			
			$xtpl->assign("padre", $catalogo->getPadre() );
			
		}
						
	}
	

}
?>