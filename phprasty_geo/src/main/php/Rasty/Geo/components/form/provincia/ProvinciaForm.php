<?php

namespace Rasty\Geo\components\form\provincia;

use Rasty\Geo\service\UIServiceFactory;

use Rasty\Geo\service\finder\PaisFinder;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\LinkBuilder;

/**
 * Formulario para Provincia

 * @author bernardo
 * @since 20/08/2014
 */
class ProvinciaForm extends Form{
		
	
	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Provincia
	 */
	private $provincia;

	
	private $pais;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("codigo");
		$this->addProperty("pais");
		
		$this->setBackToOnSuccess("Provincias");
		$this->setBackToOnCancel("Provincias");

		
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
		$entity->setCodigo( strtoupper( $entity->getCodigo() ) );
		
	}
	
	public function getType(){
		
		return "ProvinciaForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$this->fillFromSaved( $this->getProvincia() );

		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_nombre", $this->localize("provincia.nombre") );
		$xtpl->assign("lbl_codigo", $this->localize("provincia.codigo") );
		$xtpl->assign("lbl_pais", $this->localize("provincia.pais") );		
		
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
		
		$pais = $this->getPais();
		if( !empty( $pais) )
			$params["paisOid"] = $pais->getOid() ;			
			
			
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	


	public function getProvincia()
	{
	    return $this->provincia;
	}

	public function setProvincia($provincia)
	{
	    $this->provincia = $provincia;
	    
	}
	
	public function getPaisFinderClazz(){
		
		return  get_class( new PaisFinder() );
		
	}	


	public function getPais()
	{
	    return $this->pais;
	}

	public function setPaisOid($paisOid){
		
		if(!empty($paisOid)){
			
			$pais = UIServiceFactory::getUIPaisService()->get($paisOid);
			$this->setPais($pais);
		}
		
	}


	public function setPais($pais)
	{
	    $this->pais = $pais;
	}
}
?>