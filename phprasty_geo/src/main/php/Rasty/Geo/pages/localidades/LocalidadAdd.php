<?php
namespace Rasty\Geo\pages\localidades;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Cose\Geo\model\Localidad;

use Rasty\utils\LinkBuilder;

class LocalidadAdd extends EntityAdd{

	/**
	 * Localidad a agregar.
	 * @var Localidad
	 */
	private $localidad;

	protected function getLegend(){
		return $this->localize("localidad.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarLocalidad") ;
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
	
	public function getTitle(){
		return $this->localize( "localidad.agregar.title" );
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
}

?>