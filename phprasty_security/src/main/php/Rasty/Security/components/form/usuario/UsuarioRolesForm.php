<?php

namespace Rasty\Security\components\form\usuario;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Rasty\Security\components\filter\model\UIRolCriteria;
use Rasty\utils\LinkBuilder;

/**
 * Formulario para asignar roles a un usuario

 * @author Bernardo
 * @since 21/01/2015
 */
class UsuarioRolesForm extends Form{



	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;


	/**
	 *
	 * @var User
	 */
	private $usuario;


	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");

		$this->setBackToOnSuccess("Usuarios");
		$this->setBackToOnCancel("Usuarios");

	}

	public function getOid(){

		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}

	public function fillEntity($entity){

		parent::fillEntity($entity);

		//agregamos los roles.
		$roles_oids = RastyUtils::getParamPOST('roles') ;
		$roles = array();
		foreach ($roles_oids as $rolOid) {
			$roles[] = UIServiceFactory::getUIRolService()->get($rolOid);

		}
		$entity->setGroups($roles);

	}

	public function getType(){

		return "UsuarioRolesForm";

	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);


		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );

		$xtpl->assign("lbl_name", $this->localize("rol.name") );

		$legend = $this->localize("usuario.asignarRoles.legend");
        $legend = RastyUtils::formatMessage($legend, array($this->getUsuario()->getName()));

		$xtpl->assign("legend",  $legend  );

		//mostrar todos los roles marcando los asignados al usuario.

		$uiCriteria = new UIRolCriteria();
		$roles = UIServiceFactory::getUIRolService()->getList( $uiCriteria );



		foreach ($roles as $rol) {
			$xtpl->assign("rol_oid", $rol->getOid() );
			$xtpl->assign("rol_name", $rol->__toString() );

			if( $this->getUsuario()->hasUsergroupByName($rol->getName()) )
				$xtpl->assign ( 'checked', "checked" );
			else
				$xtpl->assign ( 'checked', "" );

			$xtpl->parse("main.rol" );
		}

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

		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}


	public function getUsuario()
	{
	    return $this->usuario;
	}

	public function setUsuario($usuario)
	{
	    $this->usuario = $usuario;
	}
}
?>
