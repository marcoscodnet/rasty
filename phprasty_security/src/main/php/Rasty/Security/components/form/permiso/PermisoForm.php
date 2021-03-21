<?php

namespace Rasty\Security\components\form\permiso;

use Rasty\Security\components\filter\model\UIPermisoCriteria;

use Rasty\Security\service\finder\PermisoFinder;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Security\Core\model\Permiso;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para permiso

 * @author Bernardo
 * @since 27/13/2014
 */
class PermisoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Permiso
	 */
	private $permiso;

	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("name");
		$this->addProperty("description");
		$this->addProperty("parent");
		
		$this->setBackToOnSuccess("Permisos");
		$this->setBackToOnCancel("Permisos");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "PermisoForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_name", $this->localize("permiso.name") );
		$xtpl->assign("lbl_description", $this->localize("permiso.description") );
		$xtpl->assign("lbl_parent", $this->localize("permiso.padre") );
		
	}

	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//uppercase 
		$entity->setName( ( $entity->getName() ) );
	}
	
	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getPermiso()
	{
	    return $this->permiso;
	}

	public function setPermiso($permiso)
	{
	    $this->permiso = $permiso;
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	public function getPermisoFinderClazz(){
		
		return get_class( new PermisoFinder() );
		
	}	

	public function getPermisos(){
		
		$categorias = UIServiceFactory::getUIPermisoService()->getList( new UIPermisoCriteria() );
		
		return $categorias;
		
	}
}
?>