<?php

namespace Rasty\Geo\components\boxes\provincia;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;

use Rasty\utils\LinkBuilder;

/**
 * Box para visualizar información de un Provincia.
 * 
 * @author Bernardo
 * @since 20-08-2015
 */
class ProvinciaBox extends RastyComponent{
		
	private $provincia;
	
	public function getType(){
		
		return "ProvinciaBox";
		
	}

	public function __construct(){

		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_codigo", $this->localize("provincia.codigo") );
		$xtpl->assign("lbl_nombre", $this->localize("provincia.nombre") );
		$xtpl->assign("lbl_pais", $this->localize("provincia.pais") );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$provincia = $this->getProvincia();
		
		if( !empty($provincia) ){
			
			$xtpl->assign("codigo", $provincia->getCodigo() );
			$xtpl->assign("nombre", $provincia->getNombre() );
			$xtpl->assign("pais", $provincia->getPais() );
			
		}
						
	}
	


	public function getProvincia()
	{
	    return $this->provincia;
	}

	public function setProvincia($provincia)
	{
	    $this->provincia = $provincia;
	}
}
?>