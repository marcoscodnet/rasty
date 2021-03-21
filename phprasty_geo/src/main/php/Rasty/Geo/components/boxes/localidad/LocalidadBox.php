<?php

namespace Rasty\Geo\components\boxes\localidad;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;

use Rasty\utils\LinkBuilder;

/**
 * Box para visualizar información de un Localidad.
 * 
 * @author Bernardo
 * @since 20-08-2015
 */
class LocalidadBox extends RastyComponent{
		
	private $localidad;
	
	public function getType(){
		
		return "LocalidadBox";
		
	}

	public function __construct(){

		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_codigoPostal", $this->localize("localidad.codigoPostal") );
		$xtpl->assign("lbl_nombre", $this->localize("localidad.nombre") );
		$xtpl->assign("lbl_provincia", $this->localize("localidad.provincia") );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$localidad = $this->getLocalidad();
		
		if( !empty($localidad) ){
			
			$xtpl->assign("codigoPostal", $localidad->getCodigoPostal() );
			$xtpl->assign("nombre", $localidad->getNombre() );
			$xtpl->assign("provincia", $localidad->getProvincia() );
			
		}
						
	}
	


	public function getLocalidad()
	{
	    return $this->localidad;
	}

	public function setLocalidad($localidad)
	{
	    $this->localidad = $localidad;
	}
}
?>