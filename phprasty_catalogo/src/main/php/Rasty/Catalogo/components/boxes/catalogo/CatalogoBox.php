<?php

namespace Rasty\Catalogo\components\boxes\catalogo;


use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;

use Rasty\utils\LinkBuilder;

/**
 * Box para visualizar información de un catálogo.
 * 
 * @author Bernardo
 * @since 19-08-2015
 */
class CatalogoBox extends RastyComponent{
		
	private $catalogo;
	
	public function getType(){
		
		return "CatalogoBox";
		
	}

	public function __construct(){

		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_codigo", $this->localize("catalogo.codigo") );
		$xtpl->assign("lbl_nombre", $this->localize("catalogo.nombre") );
		$xtpl->assign("lbl_descripcion", $this->localize("catalogo.descripcion") );
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$catalogo = $this->getCatalogo();
		
		if( !empty($catalogo) ){
			
			$xtpl->assign("codigo", $catalogo->getCodigo() );
			$xtpl->assign("nombre", $catalogo->getNombre() );
			$xtpl->assign("descripcion", $catalogo->getDescripcion() );
			
		}
						
	}
	


	public function getCatalogo()
	{
	    return $this->catalogo;
	}

	public function setCatalogo($catalogo)
	{
	    $this->catalogo = $catalogo;
	}
}
?>