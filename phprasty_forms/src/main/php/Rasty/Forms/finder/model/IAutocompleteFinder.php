<?php
namespace Rasty\Forms\finder\model;

/**
 * 
 * Finder para el autocomplete.
 * 
 * @author bernardo
 * @since 08/08/2013
 */
interface IAutocompleteFinder extends ICodeFinder{
	
	/**
	 * buscar entities dado un texto y un parent.
	 * @param string $text
	 * @param string $parent
	 */
	function findEntitiesByText( $text, $parent=null );

	/**
	 * atributos para mostrar en resultado del autocomplete.
	 */
	function getAttributes();

	/**
	 * atributos a retornar cuando se selecciona la entity.
	 */
	function getAttributesCallback();
	

	/**
	 * mensaje para cuando no hay resultados.
	 * @var string
	 */
	function getEmptyResultLabel();
	
	/**
	 * label para agregar una nueva entity
	 * @var string
	 */
	function getAddEntityLabel();
	
	/**
	 * función javascript a ejecutar para agregar una nueva entity.
	 * si esta property es definida se muestra el link cuando
	 * no hay resultados
	 * @var string
	 */
	function getOnclickAdd();
	
}
?>