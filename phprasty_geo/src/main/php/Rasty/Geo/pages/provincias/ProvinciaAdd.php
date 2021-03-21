<?php
namespace Rasty\Geo\pages\provincias;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Crud\pages\entities\add\EntityAdd;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Cose\Geo\model\Provincia;

use Rasty\utils\LinkBuilder;

class ProvinciaAdd extends EntityAdd{

	/**
	 * Provincia a agregar.
	 * @var Provincia
	 */
	private $provincia;

	protected function getLegend(){
		return $this->localize("provincia.add");
	}
	
	protected function getFormAction(){
		
		return LinkBuilder::getActionUrl( "AgregarProvincia") ;
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
		return $this->localize( "provincia.agregar.title" );
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