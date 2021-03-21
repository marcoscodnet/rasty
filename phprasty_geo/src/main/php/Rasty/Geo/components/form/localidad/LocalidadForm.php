<?php

namespace Rasty\Geo\components\form\localidad;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Geo\service\finder\ProvinciaFinder;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\LinkBuilder;
use Rasty\utils\Logger;

/**
 * Formulario para Localidad

 * @author bernardo
 * @since 20/08/2014
 */
class LocalidadForm extends Form{
		
	
	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Localidad
	 */
	private $localidad;

	private $provincia;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("codigoPostal");
		$this->addProperty("provincia");
		
		$this->setBackToOnSuccess("Localidades");
		$this->setBackToOnCancel("Localidades");

	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);

		$input = $this->getComponentById("backSuccess");
		$value = $input->getPopulatedValue( $this->getMethod() );
		$this->setBackToOnSuccess($value);

		//uppercase para el nombre.
		$entity->setNombre( strtoupper( $entity->getNombre() ) );
		
	}
	
	public function getType(){
		
		return "LocalidadForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$this->fillFromSaved( $this->getLocalidad() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_nombre", $this->localize("localidad.nombre") );
		$xtpl->assign("lbl_codigoPostal", $this->localize("localidad.codigoPostal") );
		$xtpl->assign("lbl_provincia", $this->localize("localidad.provincia") );		
		
	}

	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	public function getLinkCancel(){
		$params = array();
		
//		$localidad = $this->getLocalidad();
//		if( !empty( $localidad ) )
//			$params["localidadOid"] = $localidad->getOid() ;			
			
			
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	


	public function getLocalidad()
	{
	    return $this->localidad;
	}

	public function setLocalidad($localidad)
	{
	    $this->localidad = $localidad;
	}
	
	public function getProvinciaFinderClazz(){
		
		return get_class( new ProvinciaFinder() );
		
	}	

	public function setProvinciaOid($provinciaOid){
		
		if(!empty($provinciaOid)){
			
			$provincia = UIServiceFactory::getUIProvinciaService()->get($provinciaOid);
			$this->setProvincia($provincia);
		}
		
	}
	

	public function getProvincia()
	{
	    return $this->provincia;
	}

	public function setProvincia($provincia)
	{
	    $this->provincia = $provincia;
	}
}
?>