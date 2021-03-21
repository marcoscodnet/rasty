<?php

namespace Rasty\Geo\components\boxes\pais;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;

use Rasty\utils\LinkBuilder;

/**
 * Box para visualizar información de un Pais.
 * 
 * @author Bernardo
 * @since 20-08-2015
 */
class PaisBox extends RastyComponent{
		
	private $pais;
	
	public function getType(){
		
		return "PaisBox";
		
	}

	public function __construct(){

		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_codigo", $this->localize("pais.codigo") );
		$xtpl->assign("lbl_nombre", $this->localize("pais.nombre") );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$pais = $this->getPais();
		
		if( !empty($pais) ){
			
			$xtpl->assign("codigo", $pais->getCodigo() );
			$xtpl->assign("nombre", $pais->getNombre() );
			
		}
						
	}
	


	public function getPais()
	{
	    return $this->pais;
	}

	public function setPais($pais)
	{
	    $this->pais = $pais;
	}
}
?>