<?php
namespace Rasty\Geo\pages\provincias;

use Cose\Geo\model\Provincia;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\Crud\pages\entities\update\EntityUpdate;

use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

class ProvinciaUpdate extends EntityUpdate{

	protected function getEntityService(){
		
		return UIServiceFactory::getUIProvinciaService();
	}
	

	protected function getLegend(){
		return $this->localize("provincia.update");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "ModificarProvincia") ;
	}
	
	protected function getBackTo(){
		return "Provincias";
	}
	
	protected function setEntityForm( $form, $entity ){
		
		$form->setProvincia( $entity );
		
	}
	
	protected function getFormType(){
		return "ProvinciaForm";
	}	
		
	public function getLayoutType(){
		
		return "GeoLayout";
	}
	
	public function __construct(){

		parent::__construct();
		
		$provincia = new Provincia();
		
		//si viene el pais se lo seteo.
		$paisOid = RastyUtils::getParamGET("paisOid");
		if(!empty($paisOid)){
			$pais = UIServiceFactory::getUIPaisService()->get($paisOid);
			$provincia->setPais($pais);
		}
				
		$this->setEntity($provincia);
		
		
	}
	
		
	public function getTitle(){
		return $this->localize( "provincia.modificar.title" );
	}

	protected function getBackToParams(){

		$params = parent::getBackToParams();
		
		//si viene el pais se lo seteo.
		$paisOid = RastyUtils::getParamGET("paisOid");
		if(!empty($paisOid)){
			$params["paisOid"] = $paisOid;
		}
		
		return $params;
	}
}
?>