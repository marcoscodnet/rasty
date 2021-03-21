<?php
namespace Rasty\Geo\pages\localidades;

use Cose\Geo\model\Localidad;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\delete\EntityDelete;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\LinkBuilder;

class LocalidadDelete extends EntityDelete{

	protected function getEntityService(){
		
		return UIServiceFactory::getUILocalidadService();
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
	

	protected function getLegend(){
		return $this->localize("localidad.delete");
	}
	
	protected function getBackTo(){
		return "Localidades";
	}
	
	protected function setEntityBox( $box, $entity ){
		
		$box->setLocalidad( $entity );
		
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
	
	protected function getDeleteAction(){
		return "BorrarLocalidad";
	}
	
	public function getTitle(){
		return $this->localize( "localidad.eliminar.title" );
	}

	protected function getBoxTitle(){
		return $this->localize( "localidad.eliminar.title" );
	}
	
}
?>