<?php

namespace Rasty\app;

/**
 * Punto de entrada de la aplicación.
 * 
 * Es la clase responsable de atender todos los request,
 * construir los componentes y mostrarlos en pantallla.
 *   
 *   
 * @author bernardo
 * @since 03-03-2010
 */
use Rasty\conf\RastyConfig;

use Rasty\exception\UserPermissionException;

use Rasty\components\AbstractComponent;

use Rasty\factory\PageFactory;

use Rasty\exception\UserRequiredException;

use Rasty\security\RastySecurityContext;

use Rasty\actions\Forward;

use Rasty\render\HTMLRenderer;

use Rasty\factory\ComponentFactory;

use Rasty\utils\RastyUtils;

class Application{

	
	public function __construct(){
	}
	
	public function execute(Forward $forward=null){

		try {
			if($forward == null){
			
				$forward = new Forward();
				$forward->addError( RastyUtils::getParamGET( 'error' ) );
				
				$page = PageFactory::buildFromUrl( RastyUtils::getParamGET( 'path' ) );
				//echo RastyUtils::getParamGET( 'path' );
				//var_dump($page);
				//die();
			}else{
			
				$page = PageFactory::build( $forward->getPageName() );
				
			}
				
		} catch (\Exception $e) {
			$this->errorNoEsperado($e->getMessage());
			//echo "Error no esperado: " . $e->getMessage() . "";			
		}catch (Exception $e) {
			$this->errorNoEsperado($e->getMessage());
			//echo "Error no esperado: " . $e->getMessage() . "";			
		}
		
		
		if( !empty($page)){
			$page->setForward( $forward );
			
			//avisamos a los subscritores de cambios
			$listeners = RastyConfig::getInstance()->getAppListeners();
			foreach ($listeners as $listener) {
				$listener->pageExecuted( $page );
			}
			
			
			//renderizamos la p�gina.
			$render = $this->getRenderer( $page );
			$render->render( $page->getLayout() );
			
		}else{
			$this->errorNoEsperado("page.not.found");
			//echo "<h1>manejar error not found</h1>";
		}

	}
	
	public function errorNoEsperado( $mensaje="", $pageName="ErrorNoEsperado" ){
		
		$forward = new Forward();
		$forward->setPageName( $pageName );
		$forward->addError( $mensaje );
		//$forward->addParam("layout", $this->getLayoutType() );
				
		header ( 'Location: '.  $forward->buildForwardUrl() );
		die();
	}

	/**
	 * Retorna el renderer: el encargado de renderizar el resultado.
	 */
	protected function getRenderer(AbstractComponent $component){
		//por default será un html renderer.
		
		/* se lo pedimos al componente dandolé la posibilidad a cada componente
		 * de definir su propio renderer
		 * esto nos sirve más que nada para el pdf.
		 */
		return $component->getHTMLRenderer();
	}
	
	
	
}