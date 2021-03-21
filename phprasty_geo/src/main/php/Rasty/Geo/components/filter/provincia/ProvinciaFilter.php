<?php

namespace Rasty\Geo\components\filter\provincia;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Geo\service\finder\PaisFinder;

use Rasty\Geo\components\filter\model\UIProvinciaCriteria;

use Rasty\Geo\components\grid\model\ProvinciaGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filter para Catalogo
 * 
 * @author Bernardo
 * @since 14/08/2015
 */
class ProvinciaFilter extends Filter{
		
	
	public function getType(){
		
		return "ProvinciaFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new ProvinciaGridModel() ) );
		
		$this->setUicriteriaClazz( get_class( new UIProvinciaCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("codigo");
		$this->addProperty("pais");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("nombre", $this->getInitialText() );
		
		//$pais = UIServiceFactory::getUIPaisService()->get($paisOid);
		//$this->fillInput("pais", $this->getPais() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("provincia.nombre") );
		$xtpl->assign("lbl_codigo",  $this->localize("provincia.codigo") );
		$xtpl->assign("lbl_pais",  $this->localize("provincia.pais") );
			
	}
	
	public function getPaisFinderClazz(){
		
		return get_class( new PaisFinder() );
		
	}	
	
	public function setPaisOid($paisOid){
		
		if(!empty($paisOid)){
			
			$pais = UIServiceFactory::getUIPaisService()->get($paisOid);
			$this->getCriteria()->setPais($pais);
		}
		
	}
}
?>