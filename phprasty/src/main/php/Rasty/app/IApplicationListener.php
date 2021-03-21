<?php

namespace Rasty\app;

use Rasty\components\RastyPage;
use Rasty\components\RastyComponent;
use Rasty\actions\Action;
use Rasty\actions\JsonAction;

/**
 * Interface oara subscribirse a cambios
 * en la aplicación
 * 
 *   
 * @author bernardo
 * @since 26-01-2015
 */

interface IApplicationListener{

	/**
	 * se ejecuta una página
	 * @param $page
	 */
	function pageExecuted( RastyPage $page) ;
	
	/**
	 * se ejecuta un componente
	 * @param $component
	 */
	function componentExecuted( RastyComponent $component) ;
	
	/**
	 * se ejecuta un action
	 * @param $action
	 */
	function actionExecuted( Action $action) ;
	
	/**
	 * se ejecuta un action json
	 * @param $action
	 */	
	function actionJsonExecuted( JsonAction $action) ;
	
}