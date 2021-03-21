<?php

namespace Rasty\Catalogo\components\form\catalogo;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\utils\LinkBuilder;

/**
 * Formulario para catalogo

 * @author bernardo
 * @since 14/08/2014
 */
class CatalogoForm extends Form{
		
	
	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Catalogo
	 */
	private $catalogo;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("descripcion");
		$this->addProperty("codigo");
		
		$this->setBackToOnSuccess("");
		$this->setBackToOnCancel("");

		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);

		$input = $this->getComponentById("backSuccess");
		$value = $input->getPopulatedValue( $this->getMethod() );
		$this->setBackToOnSuccess($value);

		//uppercase para el nombre y el código.
		$entity->setNombre( strtoupper( $entity->getNombre() ) );
		$entity->setCodigo( strtoupper( $entity->getCodigo() ) );
		
	}
	
	public function getType(){
		
		return "CatalogoForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		$this->fillFromSaved( $this->getCatalogo() );
		
		parent::parseXTemplate($xtpl);
		
		//$xtpl->assign("legend", $this->getLegend() );
		//$xtpl->assign("action", $this->getAction() );
		//$xtpl->assign("lbl_submit", $this->localize( $this->getLabelSubmit() ) );
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_nombre", $this->localize("catalogo.nombre") );
		$xtpl->assign("lbl_descripcion", $this->localize("catalogo.descripcion") );
		$xtpl->assign("lbl_codigo", $this->localize("catalogo.codigo") );
				
		
		
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
		
		$catalogo = $this->getCatalogo();
		if( !empty( $catalogo ) )
			$params["catalogoOid"] = $catalogo->getOid() ;			
			
			
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	


	public function getCatalogo()
	{
	    return $this->catalogo;
	}

	public function setCatalogo($catalogo)
	{
	    $this->catalogo = $catalogo;
	}
}
?>