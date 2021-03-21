<?php
namespace Rasty\Forms\form;

use Rasty\Forms\finder\model\ICodeFinder;

/**
 * Default formatter para las properties del form
 * 
 * @author bernardo
 * @since 05/12/2013
 */
class NumberPropertyFormatter implements ICodeFinder{
	
	/**
	 * (non-PHPdoc)
	 * @see \Rasty\Forms\finder\model\ICodeFinder::findEntityByCode()
	 */
	function findEntityByCode( $code, $parent=null ){
//		if(strlen($code)>=1)
//			return $code;	
//		else	
//			return null;
//
		return $code;
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see \Rasty\Forms\finder\model\ICodeFinder::getEntityCode()
	 */
	function getEntityCode( $entity ){
		return $entity;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Rasty\Forms\finder\model\ICodeFinder::getEntityLabel()
	 */
	function getEntityLabel( $entity ){
		return $entity;
	}
	

	/**
	 * (non-PHPdoc)
	 * @see \Rasty\Forms\finder\model\ICodeFinder::getEntityFieldCode()
	 */
	function getEntityFieldCode( $entity ){
		return $entity;
	}

}
?>