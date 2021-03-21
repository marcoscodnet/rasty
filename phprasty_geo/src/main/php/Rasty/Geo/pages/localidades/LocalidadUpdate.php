<?php
namespace Rasty\Geo\pages\localidades;

use Cose\Geo\model\Localidad;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

class LocalidadUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUILocalidadService();
	}
	

	protected function getLegend(){
		return $this->localize("localidad.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarLocalidad") ;
	}
	
	protected function getBackTo(){
		return "Localidades";
	}
	
	protected function setEntityForm( $form, $entity ){
		
		$form->setLocalidad( $entity );
		
	}
	
	protected function getFormType(){
		return "LocalidadForm";
	}	
		
	public function getLayoutType(){
		
		return "GeoLayout";
	}
	
	public function __construct(){

		parent::__construct();
		
		$localidad = new Localidad();

		//si viene la provincia se la seteo.
		$provinciaOid = RastyUtils::getParamGET("provinciaOid");
		if(!empty($provinciaOid)){
			$provincia = UIServiceFactory::getUIProvinciaService()->get($provinciaOid);
			$localidad->setProvincia($provincia);
		}
		
		$this->setEntity($localidad);
		
		
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
		
	public function getTitle(){
		return $this->localize( "localidad.modificar.title" );
	}

}
?>