<?php
namespace Rasty\Geo\components\filter\localidad;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Geo\service\finder\ProvinciaFinder;

use Rasty\Geo\components\filter\model\UILocalidadCriteria;

use Rasty\Geo\components\grid\model\LocalidadGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filter para Catalogo
 * 
 * @author Bernardo
 * @since 14/08/2015
 */
class LocalidadFilter extends Filter{
		
	public function getType(){
		
		return "LocalidadFilter";
	}
	
	public function setProvinciaOid($provinciaOid){
		
		if(!empty($provinciaOid)){
			
			$provincia = UIServiceFactory::getUIProvinciaService()->get($provinciaOid);
			$this->getCriteria()->setProvincia($provincia);
		}
		
	}

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new LocalidadGridModel() ) );
		
		$this->setUicriteriaClazz( get_class( new UILocalidadCriteria()) );
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("codigoPostal");
		$this->addProperty("provincia");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("localidad.nombre") );
		$xtpl->assign("lbl_codigoPostal",  $this->localize("localidad.codigoPostal") );
		$xtpl->assign("lbl_provincia",  $this->localize("localidad.provincia") );
			
	}
	
	public function getProvinciaFinderClazz(){
		
		return get_class( new ProvinciaFinder() );
		
	}
}
?>