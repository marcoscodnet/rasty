<?php
namespace Rasty\Security\service\finder;

use Rasty\Security\components\filter\model\UIUsuarioCriteria;

use Rasty\Security\service\UIServiceFactory;

use Rasty\Forms\finder\model\IAutocompleteFinder;
/**
 * 
 * Finder para Usuario.
 * 
 * @author Bernardo
 * @since 06/11/2014
 */
class UsuarioFinder implements  IAutocompleteFinder {
	
	
	public function __construct() {}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntitiesByText()
	 */
	public function findEntitiesByText( $text, $parent=null ){
		
		$uiCriteria = new UIUsuarioCriteria();
		$uiCriteria->setUsername( $text );
		$uiCriteria->setRowPerPage( 10 );
		return UIServiceFactory::getUIUsuarioService()->getList($uiCriteria);	
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){
		
		return UIServiceFactory::getUIUsuarioService()->get( $code );
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributes()
	 */
	public function getAttributes(){
		return array("username", "name");		
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getAttributesCallback()
	 */
	public function getAttributesCallback(){
		return array("oid", "username", "name");		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		if( !empty( $entity)  )
		
		return $entity->getOid();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityLabel()
	 */
	function getEntityLabel( $entity ){
		if( !empty( $entity)  )
		return $entity->getUsername();
	}

	/**
	 * (non-PHPdoc)
	 * @see service/finder/Rasty\Forms\finder\model.IAutocompleteFinder::getEntityFieldCode()
	 */
	function getEntityFieldCode( $entity ){
		return "oid";
	}
	
	/**
	 * mensaje para cuando no hay resultados.
	 * @var string
	 */
	function getEmptyResultLabel(){
		return null;
	}
	
	/**
	 * label para agregar una nueva entity
	 * @var string
	 */
	function getAddEntityLabel(){
		return null;
	}
	
	/**
	 * función javascript a ejecutar para agregar una nueva entity.
	 * si esta property es definida se muestra el link cuando
	 * no hay resultados
	 * @var string
	 */
	function getOnclickAdd(){
		return "";
	}
}
?>