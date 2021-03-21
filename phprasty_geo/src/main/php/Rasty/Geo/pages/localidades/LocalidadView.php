<?php
namespace Rasty\Geo\pages\localidades;

use Rasty\Geo\service\UIServiceFactory;

use Cose\Geo\model\Localidad;


use Rasty\Crud\pages\entities\view\EntityView;

use Rasty\utils\XTemplate;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

class LocalidadView extends EntityView{

	protected function getEntityService(){
		
		return UIServiceFactory::getUILocalidadService();
	}
	

	protected function getLegend(){
		return $this->localize("localidad.view");
	}
	
	protected function getBackTo(){
		return "Localidades";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setLocalidad( $entity );
		
	}
	
	protected function getBackToParams(){

		$params = parent::getBackToParams();
		
		//si viene la provincia, la seteo
		$provinciaOid = RastyUtils::getParamGET("provinciaOid");
		if(!empty($provinciaOid)){
			$params["provinciaOid"] = $provinciaOid;
		}
		
		return $params;
	}
	
	protected function getBoxType(){
		return "LocalidadBox";
	}	
		
	public function getLayoutType(){
		
		return "GeoLayout";
	}
	
	public function __construct(){

		parent::__construct();
		
		$localidad = new Localidad();
		$this->setEntity($localidad);
		
		
	}
	
	public function getTitle(){
		return $this->localize( "localidad.consultar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "localidad.consultar.title" );
	}
	
}
?>