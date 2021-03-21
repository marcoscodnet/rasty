<?php
namespace Rasty\Forms\finder\model;

/**
 * 
 * Finder para encontrar entities dado su código
 * 
 * @author bernardo
 * @since 05/12/2013
 */
interface ICodeFinder {
	

	/**
	 * buscar una entity dado su identificador.
	 * @param string $code
	 */
	function findEntityByCode( $code, $parent=null );
	
	
	/**
	 * obtiene el id de la entity
	 * @param unknown_type $entity
	 */
	function getEntityCode( $entity );
	
	/**
	 * obtiene el label de la entity
	 * @param $entity
	 */
	function getEntityLabel( $entity );

	/**
	 * obtiene el nombre del atributo id de la entity
	 * @param $entity
	 */
	function getEntityFieldCode( $entity );

}
?>